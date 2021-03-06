

@extends('layouts.app')
<style>
    * {
  margin: 0px; padding: 0px;
  border: none;
  box-sizing: border-box;
}

html, body {
  background: #333B3D;
  font: 14px Tahoma, Geneva, sans-serif;
  width: 100%; height: 100%;
}

header {
  margin: 0px auto;
  position: relative;
  width: 90%; max-width: 960px;
  height: 100px;
}

header h1 {
  margin: 0px; padding: 50px 0px 0px;
  color: #EEE;
  font-size: 30px;
}

.mailbox {
  margin: 0px auto -100px;
  position: relative;
  background: #CCDDED;
  border-radius: 0px 5px 0px 0px;
  width: 90%; max-width: 960px;
}

.nav {
  position: absolute;
  top: 0px; bottom: 0px;
  background: #EEE;
  width: 200px;
}

.nav a {
  display: block;
  padding: 5px 10px;
  color: #3D9FC4;
  font-weight: bold;
  text-decoration: none;
}

.nav a.active {
  background: #CCDDED;
}

.nav a:first-child {
  margin: 10px 0px 10px;
}

.messages {
  padding: 10px 10px 10px 210px;
  width: 100%;
}

.actions-dropdown {
  display: block;
  float: right;
  position: relative;
  margin: 5px 10px 10px 0px;
}

.actions-dropdown label {
  padding: 5px 10px;
  background: #EEE;
  color: #666;
  border-radius: 5px;
  cursor: pointer;
}

.actions-dropdown label span {
  color: #999;
  font-size: 10px;
}

.actions-dropdown:hover ul {
  display: block;
}

.actions-dropdown ul {
  display: none;
  position: absolute;
  list-style: none;
  background: #EEE;
  border-radius: 5px;
  width: 100%;
}

.actions-dropdown li {
  padding: 5px 10px;
  color: #666;
  cursor: pointer;
}

.actions-dropdown li:hover {
  color: #000;
}

.actions-dropdown li:first-child {
  margin-top: 5px;
}

input[name=search] {
  display: block;
  float: right;
  margin-bottom: 10px;
  padding: 5px 10px;
  background: #EEE;
  font: 14px Tahoma, Geneva, sans-serif;
  border-radius: 5px;
}

input[name=search]:focus {
  outline: none;
}

.message {
  clear: both;
  margin-bottom: 5px;
  position: relative;
  padding: 5px;
  background: #bbd0e4;
  border-radius: 5px;
}

.message input {
  position: absolute;
  top: 8px; left: 10px;
  width: 30px;
}

.message .sender {
  display: block;
  position: absolute;
  left: 40px;
  color: #000;
  font-weight: bold;
  width: 90px;
}

.message .title {
  display: inline-block;
  padding-left: 150px;
  width: 100%;
}

.message .date {
  position: absolute;
  right: 10px;
}
</style>
@section('content')


<header>
  <h1>messages</h1>
</header>

{{-- <div class="mailbox">
  <div class="nav">
      @foreach($aFolder[0]->children  as $key => $value)
      <a href="#">{{ Illuminate\Support\Str::after($value->full_name,'INBOX.')  }}</a>
      @endforeach
  

  </div>
  <div class="messages">
    <input name="search" placeholder="search" />
    <div class="actions-dropdown">
      <label>actions <span>▼</span></label>
      <ul>
        <li>flag</li>
        <li>move</li>
        <li>delete</li>
      </ul>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
    <div class="message">
      <input type="checkbox" />
      <span class="sender">lauren</span>
      <span class="date">today</span>
      <span class="title">hello world</span>
    </div>
    
  </div>
</div> --}}
<h1>Inbox</h1>
<table>
  <thead>
      <tr>
          <th>UID</th>
          <th>Subject</th>
          <th>From</th>
          <th>Attachments</th>
      </tr>
  </thead>
  <tbody>
      @if($oFolderArchive->count() > 0)
          @foreach($oFolderArchive as $oMessage)
              <tr>
                  <td>{{$oMessage->getUid()}}</td>
                  <td>{{$oMessage->getSubject()}}</td>
                  <td>{{$oMessage->getFrom()[0]->mail}}</td>
                  <td>{{$oMessage->getAttachments()->count() > 0 ? 'yes' : 'no'}}</td>
              </tr>
          @endforeach
      @else
          <tr>
              <td colspan="4">No messages found</td>
          </tr>
      @endif
  </tbody>
</table>
<h1>Archive</h1>
<table>
  <thead>
      <tr>
          <th>UID</th>
          <th>Subject</th>
          <th>From</th>
          <th>Attachments</th>
      </tr>
  </thead>
  <tbody>
      @if($paginator->count() > 0)
          @foreach($paginator as $oMessage)
              <tr>
                  <td>{{$oMessage->getUid()}}</td>
                  <td>{{$oMessage->getSubject()}}</td>
                  <td>{{$oMessage->getFrom()[0]->mail}}</td>
                  <td>{{$oMessage->getAttachments()->count() > 0 ? 'yes' : 'no'}}</td>
              </tr>
          @endforeach
      @else
          <tr>
              <td colspan="4">No messages found</td>
          </tr>
      @endif
  </tbody>
</table>

@endsection
