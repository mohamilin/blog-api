<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Topic;


class TopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showTopic']]);
    }

    public function showTopic()
    {
        $topic = Topic::select('topic_id', 'topic_name', 'slug')->get();
        $topic_list = $topic->toArray();
        return response()->json([
            'status' => true,
            'message' => 'All articles fetched',
            'value' => $topic_list
        ], 200);

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
}
