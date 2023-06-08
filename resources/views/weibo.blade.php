<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>微博热搜</title>

</head>
<style>
    .center {
        max-width: 100%;
        margin: 0 auto;
        padding: 10px;
        box-sizing: border-box;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    a {
        text-decoration: none;
    }
</style>
<body>
<div class="center">
    <table>
        <tr>
            <th>排名</th>
            <th>标题</th>
        </tr>
        @foreach ($weibos as $weibo)
            <tr>
                <td>{{$weibo->no}}</td>
                <td><a target="_blank" href="{{$weiboHost}}{{$weibo->url}}">{{$weibo->title}}</a></td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
