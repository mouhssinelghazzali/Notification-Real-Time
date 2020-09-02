<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\NewNotification;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webklex\IMAP\Client;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $oClient = new Client([
            'host'          => 'qualinet.ma',
            'port'          => 993,
            'validate_cert' => false,
            'username'      => 'test@qualinet.ma',
            'password'      => '[A]CB?Dl~;8}',
            'protocol'      => 'imap'
        ]);
        /* Alternative by using the Facade
        $oClient = Webklex\IMAP\Facades\Client::account('default');
        */
      
        //Connect to the IMAP Server
        $oClient->connect();
        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders();
        //dd($aFolder[0]->children[0]);

        
        $oFolder = $oClient->getFolder('INBOX.read');
        $oFolderArchive = $oClient->getFolder('INBOX.Archive');
        $oFolderArchive = $oFolderArchive->query()->all()->get();
        // $paginator = $oFolder->search()
        //              ->since(\Carbon::now()->subDays(14))->get()
        //              ->paginate(5);
        $paginator = $oFolder->query()->all()->get();
           
     dd($aFolder);
        return view('home',compact('aFolder','paginator','oFolderArchive'));
    }

    public function save(Request $request)
    {
        $data = [
            'post_id' => $request->post_id ,
            'user_id' => Auth::id(),
            'comment' => $request->post_content,
        ];
        Comment::create($data);
        
        
        event(new NewNotification($data));
            
        return redirect()->back()->with(['success' => 'avec success']);
    }
}
