<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Article;
use App\Models\Topic;


class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showArticle', 'showArticleById', 'indexArticleByTopic']]);
    }

    public function showArticle()
    {
        $article = Article::select('article_id', 'topic_id', 'title', 'body',  'slug')->get();
        $article_list = $article->toArray();
        if(!empty($article_list)){
            return response()->json([
                'status' => true,
                'message' => 'All articles fetched',
                'value' => $article_list
            ], 200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'Data Not found.'
            ], 404);
        }
       
    }


    public function showArticleById($article_id)
    {
        $data = Article::find($article_id);

            // kondisi return dalam bentuk berbeda
        return !empty($data) ? response()->json([
            'status' => 'true',
            'message' => 'Article : ' .  $data->title,
            'data' => $data
        ]) : response()->json([
            'status' => 'false',
            'message' => 'Not found.'
        ], 404);
    }

    public function indexArticleByTopic($topic_id)
    {
        $data = Article::where('topic_id', '=', $topic_id)
            ->get(['article_id', 'topic_id',  'title', 'slug','body']);

        // kondisi jika data nya tidak kosong 
        // kembalikan dalam respon bentuk json
        // saya buat bentuk nya dalam kondisi bentuk berbeda
        return !$data->isEmpty() ? response()->json([
            'status' => 'true',
            'message' => 'All articles in ID Topic : ' .  $topic_id,
            'value' => $data
        ]) : response()->json([
            'status' => 'false',
            'message' => 'Not found.'
        ], 404);
    }

    public function createArticle(Request $request)
    {

        $title = $request->input('title');
        $body = $request->input('body');
        $topic_id = $request->input('topic_id');

        $article = Article::create(
            [
                'title' => $title,
                'slug'  => Str::slug($title, "-"),
                'body' => $body,
                'topic_id' => $topic_id
            ]
        );
        $article_new = $article->select('article_id', 'topic_id', 'title', 'slug', 'body')->get()->last();
        if ($article_new) {
            return response()->json([
                'status' => true,
                'message' => 'Topic :  successfully created',
                'value' =>  $article_new
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Topic : $topic_name not success created',
                'value' => ''
            ], 404);
        }
    }

    public function updateArticle(Request $request, $article_id)
    {
        if ($request->isMethod('patch')) {

            $this->validate($request, [
                'topic_id' => 'required',
                'title' => 'required',
                'body' => 'required',
            ]);

            $topic_id = $request->input('topic_id');
            $title = $request->input('title');
            $body = $request->input('body');

            $article = Article::find($article_id);
            $data = [
                'article_id' => $article->article_id,
                'topic_id' => $topic_id,
                'title' => $title,
                'body' => $body,
                'slug'  => Str::slug($title, "-"),
            ];

            $update_article = $article->update($data);

            if ($update_article) {
                return response()->json([
                    'status' => true,
                    'message' => 'Topic : ' . $title . ' successfully updated',
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

    public function deleteArticle($article_id)
    {
        $article = Article::find($article_id);

        if (empty($article)) {
            return response()->json([
                'status' => 'false',
                'message' => 'Not Found article'
            ], 404);
        }
        if($article->delete()){
            return response()->json([
                'status' => 'true',
                'message' => 'Article deleted'
            ], 200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'Server is not ready.'
            ], 503);
        }
             // versi lain kalau bwt condition of return in delete
        // return $article->delete() ? response()->json([
        //     'status' => 'true',
        //     'message' => 'Article deleted'
        // ], 200) : response()->json([
        //     'status' => 'false',
        //     'message' => 'Server is not ready.'
        // ], 503);
    }
}
