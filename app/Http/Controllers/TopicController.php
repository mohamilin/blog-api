<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Topic;


class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showTopic', 'showTopicById', 'showArticleByTopic']]);
    }

    public function showTopic()
    {
        $topic = Topic::select('topic_id', 'topic_name', 'slug')->get();
        $topic_list = $topic->toArray();
        if(!empty($topic_list)) {
            return response()->json([
                'status' => true,
                'message' => 'All articles fetched',
                'value' => $topic
            ], 200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'Data Not found.'
            ], 404);
        }
       
    }


    public function showTopicById($topic_id)
    {
        $data = Topic::find($topic_id, ['topic_id', 'topic_name', 'slug']);


        return !empty($data) ? response()->json([
            'status' => 'true',
            'message' => 'All articles fetched by ID topic : ' . $topic_id,
            'value' => $data
        ]) : response()->json([
            'status' => 'false',
            'message' => 'Not found.'
        ], 404);
    }

    public function createTopic(Request $request)
    {
        $topic_name = $request->input('topic_name');
        $topic = Topic::create([
            'topic_name' => $topic_name,
            'slug'  => Str::slug($topic_name, "-"),
        ]);

        $topic_new = $topic->select('topic_id', 'topic_name')->get()->last();
        if ($topic_new) {
            return response()->json([
                'status' => true,
                'message' => 'Topic : ' . $topic_name . ' successfully created',
                'value' =>  $topic_new
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Topic : $topic_name not success created',
                'value' => ''
            ], 404);
        }
    }

    public function updateTopic(Request $request, $topic_id)
    {


        if ($request->isMethod('patch')) {

            $this->validate($request, [
                'topic_name' => 'required',

            ]);
            $topic_name = $request->input('topic_name');
            $topic = Topic::find($topic_id);

            $data = [
                'topic_id' => $topic->topic_id,
                'topic_name' => $topic_name,
                'slug'  => Str::slug($topic_name, "-"),
            ];

            $update = $topic->update($data);

            if ($update) {
                return response()->json([
                    'status' => true,
                    'message' => 'Topic : ' . $topic_name . ' successfully updated',
                    'value' =>  $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Not Success update',
                    'value' =>  ''
                ], 404);
            }
        }
    }

    public function deleteTopic($topic_id)
    {
        $topic = Topic::find($topic_id);

        if (empty($topic)) {
            return response()->json([
                'status' => 'false',
                'message' => 'Not Found article'
            ], 404);
        }

        if($topic->delete()){
            return response()->json([
                'status' => 'true',
                'message' => 'Topic deleted'
            ], 200);
        }else {
            return response()->json([
                'status' => 'false',
            'message' => 'Server is not ready.'
            ], 503);
        }
            // versi lain kalau bwt condition of return in delete
        // return $topic->delete() ? response()->json([
        //     'status' => 'true',
        //     'message' => 'Topic deleted'
        // ], 200) : response()->json([
        //     'status' => 'false',
        //     'message' => 'Server is not ready.'
        // ], 503);
    }
}
