<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use \App\Role;
use \App\User;
use \App\Comment;
use \App\Reply;
use \App\PostReply;
use Auth;
use \App\Post;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        // API1 = AIzaSyCTS7QLzRuSwHSzUiGHZ3_7L1aq--gq230
        // API2 = AIzaSyCXOy5gDqIjUjLBVV0AfFK9Oq7VesEoxbE
        // API3 = AIzaSyCc3GDZgmId-Dm-nP5zXqO6ga2q7ME0DvU
        // API4 = AIzaSyB9ObPqwcApMEiDuqApeqn2gKFXzzO7qkQ
        // API5 = AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4 = current
        
    public function landingPage () {
        $creator = User::where('role_id', 2)->get()->shuffle();
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        // $allCreator = [];
        $approved_post = [];
        $json_result = [];
        foreach($creator as $indiv_creator) {
            $creator_id = $indiv_creator->youtube;            
            
            $channelID = $creator_id;
            $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));


            $json_result[$indiv_creator->id] = $result;

 
        }

        $article = Post::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        
        $post_comment = PostReply::All();
        


        return view ('pages.landingpage', compact('json_result', 'result', 'article', 'post_comment'));
        

    	
    }

    public function mvph () {
       

        return view ('pages.mvph');
    }

    public function content_creator($id) {
        $channelID = $id;
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $maxResults = 50;

        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));

        $profile = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));

        $userFeed = User::where('youtube', $id)->first();
        
     

    	$feed = Comment::where('user_id', $userFeed->id)->orderBy('created_at', 'desc')->get();
        
        $feed_replies = Reply::All();



        return view ('pages.content_creator', compact('result', 'profile', 'feed', 'feed_replies'));

        
    }

    public function video($id) {
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $VIDEO_id = $id;

        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$VIDEO_id.'&key='.$API_key.''));
        

        $commentResult = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/commentThreads?part=snippet%2Creplies&videoId='.$VIDEO_id.'&key='.$API_key.''));
        // dd($commentResult);

        // $result3 = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/comments?part=snippet&key='.$API_key.''));
        // dd($result3);

        // foreach ($commentResult->items as $dd) {
        //     dd($dd->replies);
        //     foreach($dd->replies as $dc) {
                 
        //         foreach ($dc as $d) {
        //             dd($d->snippet->textDisplay);
        //         }
        //     }
        // }

        // $replyResult = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/comments?part=snippet&parentId=UgxFpfRLw4hfGG8rtDl4AaABAg&key=AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4'));
        // dd($replyResult);

        // foreach ($replyResult->items as $reply) {
        //     dd($reply->snippet->textDisplay);
        // }


        return view ('pages.video', compact('result', 'commentResult'));

    }

    public function profile ($id) {
        $channelID = $id;
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $maxResults = 50;

        $profile1 = User::where('youtube', $id)->first();

        $userToSubmitArticle = User::where('youtube', $id)->first();

        $article = Post::where('user_id', $userToSubmitArticle->id)->orderBy('created_at', 'desc')->get();

        // dd($article);

        $userFeed = User::where('youtube', $id)->first();
        

        // get video
        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));
       // get profile
        $profile = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));
        

        $feed = Comment::where('user_id', $userFeed->id)->orderBy('created_at', 'desc')->get();
        
        return view ('pages.profile', compact('profile1', 'article', 'feed', 'profile'));
    }
    // view userprofile of non vlogger
    public function viewProfile ($id) {
        // dd($id);

        $channelID = $id;
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $maxResults = 50;

        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));

        $profile = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));

        $userFeed = User::where('youtube', $id)->first();
        
     

        $feed = Comment::where('user_id', $userFeed->id)->orderBy('created_at', 'desc')->get();
        
        $feed_replies = Reply::All();



        return view ('pages.content_creator', compact('result', 'profile', 'feed', 'feed_replies'));
    }

    public function manageUsers () {
        $admin = User::where('role_id', 3)->get();
        $test = Comment::All();
        $contentCreator = User::where('role_id', 2)->get();
        $viewer = User::where('role_id', 1)->get();

        
        return view ('pages.manageusers', compact('admin', 'contentCreator', 'viewer'));
    }


    public function userPost ($id, Request $request) {
        // dd($request->feed);

        $channelID = $id;
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $maxResults = 50;

        $user = User::where('youtube', $id)->first();

        $user_final = $user->id;
        // dd($user->id);

        $newFeed = new Comment;
        $newFeed->user_id=$user_final;
        $newFeed->comment=$request->feed;
        $newFeed->save();

        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));
       
        $profile = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));

        $userFeed = User::where('youtube', $id)->first();
        
        $feed = Comment::where('user_id', $userFeed->id)->orderBy('created_at', 'desc')->get();
        return redirect()->back();
        // return view ('pages.content_creator', compact('profile', 'feed', 'result'));
    }

    public function deletePost ($id, Request $request) {
        // dd($id);
        $postToDelete = Comment::find($id);
        $postToDelete->delete();
        // dd($request);
        $channelID = $request->youtube;
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $maxResults = 50;
        

        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));
       
        $profile = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));

        $userFeed = User::where('youtube', $request->youtube)->first();
        
        $feed = Comment::where('user_id', $userFeed->id)->orderBy('created_at', 'desc')->get();

        // return view('pages.content_creator', compact('feed', 'profile', 'result'));
        return redirect()->back(); 
    }   

    public function editPost ($id, Request $request) {
        // dd($request);
        $channelID = $request->youtube;
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        $maxResults = 50;

        $postToEdit = Comment::find($request->id);
        // dd($postToEdit);
        $postToEdit->comment = $request->edit_post;
        $postToEdit->save();


        $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));
       
        $profile = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));

        $userFeed = User::where('youtube', $id)->first();
        // dd($userFeed);
        $feed = Comment::where('user_id', $userFeed->id)->orderBy('created_at', 'desc')->get();
        
        $feed = Comment::where('user_id', $userFeed->id)->get();
        // return view('pages.content_creator', compact('feed', 'profile', 'result'));
        return redirect()->back();

    }

    public function makeViewerContentCreator ($id) {
        // dd($id);
        $makeCC = User::where('youtube', $id)->first();
        // dd($makeCC->role_id);

        $makeCC->role_id=2;
        $makeCC->save();
        return redirect('/admin/manage');
    }

    public function demoteToViewer ($id) {
        $demote = User::where('youtube', $id)->first();
        $demote->role_id=1;
        $demote->save();
        return redirect('/admin/manage');
    }

    public function makeAdmin ($id) {
        $makeAdmin = User::where('youtube', $id)->first();
        $makeAdmin->role_id=3;
        $makeAdmin->save();
        return redirect('/admin/manage');
    }

    public function deleteUser ($id) {
        // dd($id);
        $userToDelete = User::where('youtube', $id)->first();
        // dd($userToDelete);
        $userToDelete->delete();
        return redirect('/admin/manage');
    }

    public function submitArticle ($id, Request $request) {
        $userToSubmitArticle = User::where('youtube', $id)->first();
        // dd($request);
        $newArticle = new Post;
        $newArticle->subject = $request->subject;
        $newArticle->content = $request->content;
        $newArticle->user_id = $userToSubmitArticle->id;
        $newArticle->save();

        $profile1 = User::where('youtube', $id)->first();

        $article = Post::where('user_id', $userToSubmitArticle->id)->orderBy('created_at', 'desc')->get();

        // dd($article);
        
        return redirect()->back();
    }

    public function manageArticle() {

        $approved = Post::where('status', "approved")->get();
        $pending = Post::where('status', "pending")->get();
        $rejected = Post::where('status', "rejected")->get();
        // dd($article);

        return view('pages.manage_post', compact ('approved', 'pending', 'rejected'));
    }

    public function approvePost ($id) {
        $postToApprove = Post::where('id', $id)->first();
        // dd($postToApprove);
        $postToApprove->status="approved";
        $postToApprove->save();

        return redirect()->back();
    }

    public function rejectPost ($id) {
        $postToReject = Post::where('id', $id)->first();
        $postToReject->status="rejected";
        $postToReject->save();

        return redirect()->back();
    }
    public function pendingPOst ($id) {
        $postToPending = Post::where('id', $id)->first();
        $postToPending->status="pending";
        $postToPending->save();

        return redirect()->back();
    }

    public function deleteArticle ($id) {
        // dd($id);
        $articleToDelete = Post::where('id', $id)->first();
        // dd($articleToDelete);
        $articleToDelete->delete();
        return redirect()->back();
    }

    public function editArticle ($id, Request $request) {
        $articleToEdit = Post::where('id', $id)->first();
        $articleToEdit->subject=$request->subject;
        $articleToEdit->content=$request->content;
        $articleToEdit->save();
        return redirect()->back();
    }

    public function reply (Request $request){
        // dd($request);
        $addReply = new Reply;
        $addReply->reply=$request->reply;
        $addReply->comment_id=$request->comment_id;
        $addReply->user_id=$request->user_id;
        $addReply->save();
        return redirect()->back();
    }

    public function addCommentToPost(Request $request) {
        // dd($request);
        $commentToAdd = new PostReply;
        $commentToAdd->reply=$request->reply;
        $commentToAdd->post_id=$request->post_id;
        $commentToAdd->user_id=$request->user_id;
        $commentToAdd->save();

        return redirect()->back();

    }

    public function news () {
        $article = Post::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        $post_comment = PostReply::All();
        return view ('pages.news', compact('article', 'post_comment'));
    }

    public function contentCreatorSolo () {
        $creator = User::where('role_id', 2)->get()->shuffle();
        $API_key    = 'AIzaSyBfPyGnJiMoYY3A2AXWzca8I-2yMh-ZSu4';
        // $allCreator = [];
        $approved_post = [];
        $json_result = [];
        foreach($creator as $indiv_creator) {
            $creator_id = $indiv_creator->youtube;            
            
            $channelID = $creator_id;
            $result = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$channelID.'&key='.$API_key.''));


            $json_result[$indiv_creator->id] = $result;

 
        }
            return view ('pages.content_creator_solo', compact('json_result', 'result'));
    }

    public function deleteComment ($id) {
        $commentToDelete = PostReply::where('id',$id)->first();
        // dd($commentToDelete);
        $commentToDelete->delete();
        return redirect()->back();
    }

    public function deleteCommentFromFeed ($id) {
        $commentToDelete = Reply::where('id',$id)->first();
        // dd($commentToDelete);
        $commentToDelete->delete();
        return redirect()->back();
    }

    public function editComment ($id, Request $request) {
        $commentToEdit = PostReply::where('id',$id)->first();
        // dd($request);
        $commentToEdit->reply=$request->edit_reply;
        $commentToEdit->save();
        return redirect()->back();
    }

    public function editPostComment ($id, Request $request) {
        // dd($id);
        $commentToEdit = Reply::where('id',$id)->first();
        // dd($request);
        $commentToEdit->reply=$request->edit_reply;
        $commentToEdit->save();
        return redirect()->back();
    }

}



 
