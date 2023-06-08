<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>微博热搜</title>

</head>
<style>
    .center {
        width:400px;
        margin:0 auto;
    }
</style>
<body>
<div class="center">
<table>
    <tr><th>排名</th><th>标题</th></tr>
    @foreach ($weibos as $weibo)
    <tr>
        <td>{{$weibo->no}}</td><td><a target="_blank" href="{{$weiboHost}}{{$weibo->url}}">{{$weibo->title}}</a></td>
    </tr>
    @endforeach
</table>
</div>
</body>
</html>
