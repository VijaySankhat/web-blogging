<?php

namespace App\Services;


use App\Client\AbstractClient;
use App\Constants\ImportJsonKey;
use App\Models\Post;
use App\Models\User;
use App\Models\UserImport;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostImportService extends AbstractClient
{

    private $client;
    private $url;
    private $authorId;

    public function importPost(int $authorId, string $url) : void
    {
        $this->url = $url;
        Log::info("Start import for author => {$authorId}");
        $this->authorId = $authorId;
        $this->client = $this->getClient();
        $res = $this->getResponse();
        if(!empty($res) && isset($res->data) && is_array($res->data)) {
            $this->insertPost($res->data);
        }
    }

    /**
     * @param int $retry
     * @return mixed|null
     */
    public function getResponse(int $retry = 3)
    {
        //If fail try 3 times
        return $this->retry($retry);
    }

    /**
     * @param Client $client
     * @param int $retry
     * @param int $retryCount
     * @return mixed|null
     */
    private function retry(int $retry, int $retryCount = 1)
    {
        $res = null;
        try {
            $res = $this->client->request("GET",$this->url);
            //Status 200
            if($res->getStatusCode() === 200) {
                Log::info("Response received");
                return json_decode($res->getBody()->getContents());
            }
        }
        //Exception, handle it with log
        catch (ConnectException $ex) {
            Log::critical($ex->getMessage(), [
                "url" => $this->url,
                "class" => $ex->getFile(),
                "method"    => __METHOD__,
                "line"  => $ex->getLine()
            ]);
        }
        catch (ClientException $ex) {
            Log::critical($ex->getMessage(), [
                "url" => $this->url,
                "body" => $ex->getResponse()->getBody()->getContents(),
                "class" => $ex->getFile(),
                "method"    => __METHOD__,
                "line"  => $ex->getLine()
            ]);
        }
        catch (GuzzleException $ex) {
            Log::critical($ex->getMessage(), [
                "url" => $this->url,
                "class" => $ex->getFile(),
                "method"    => __METHOD__,
                "line"  => $ex->getLine()
            ]);
        }
        finally {
            Log::info("Trying import {$retryCount} time", [
                "url" => $this->url
            ]);
            if($retryCount === $retry)   {
                return null;
            }
            if($res != null && $res->getStatusCode() != 200) {
                //Recursive call to match the max retry count
                $this->retry($retry, ++$retryCount);
            }
        }
    }


    /**
     * @param array $data
     */
    private function insertPost(array $data) : void
    {
        try {
            $user = User::findOrFail($this->authorId);
            if($user->isAdmin()) {
                Post::insert($this->prepareInsert($data));
            } else {
                Log::critical("Unauthorized import", ["author" => $this->authorId]);
            }
        } catch (\Exception $ex) {
            Log::critical($ex->getMessage(), [
                "author" => $this->authorId,
                "message" => "Couldn't import post",
                "class" => $ex->getFile(),
                "method"    => __METHOD__,
                "line"  => $ex->getLine()
            ]);
        }
    }

    /**
     * @param $data
     * @return array
     */
    private function prepareInsert($data): array {
        $count = 0;
        $insertData = [];
        foreach ($data as $single) {
            if($this->isPostCompatible($single) === false) {
                continue;
            }
            $insertData[$count]["author_id"] = $this->authorId;
            $insertData[$count]["slug"] = Str::slug($single->title, '-').get_slug_uuid();
            $insertData[$count][ImportJsonKey::TITLE] = $single->title;
            $insertData[$count][ImportJsonKey::DESCRIPTION] = $single->description;
            $insertData[$count][ImportJsonKey::PUB_DATE] = $single->publication_date;
            $count++;
        }
        return $insertData;
    }

    /**
     * @param $post
     * @return bool
     */
    private function isPostCompatible($post) : bool
    {
        if(!isset($post->title) || !isset($post->description) || !isset($post->publication_date)) {
            return false;
        }
        return true;
    }

    /**
     * @param int $jobId
     * @param bool $status
     */
    public function updateImportStatus(string $jobId, bool $status = false)
    {
        try {
            UserImport::whereJobId($jobId)->update(["status" => $status]);
        } catch (\Exception $ex) {
            Log::critical($ex->getMessage(), [
                "class" => $ex->getFile(),
                "method"    => __METHOD__,
                "line"  => $ex->getLine()
            ]);
        }
    }
}