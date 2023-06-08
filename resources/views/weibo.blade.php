<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>微博热搜</title>

</head>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
        line-height: 1.5;
    }
    .center {
        max-width: 100%;
        margin: 0 auto;
        padding: 10px;
        box-sizing: border-box;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
    }
    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    td:first-child {
        font-weight: bold;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
    }
    a {
        color: #007bff;
        text-decoration: none;
    }
</style>
<body>
<div class="center">
    <input type="text" id="search" placeholder="请输入关键词搜索">
    <table>
        <thead>
        <tr>
            <th>排名</th>
            <th>标题</th>
        </tr>
        </thead>
        <tbody id="table-body">
        @foreach ($weibos as $weibo)
            <tr>
                <td>{{$weibo->no}}</td>
                <td><a target="_blank" href="{{$weiboHost}}{{$weibo->url}}">{{$weibo->title}}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    const tableBody = document.getElementById('table-body');
    const searchInput = document.getElementById('search');

    // 排序函数，按照第一列的数字大小排序
    function sortTableByFirstColumn() {
        const rows = Array.from(tableBody.rows);
        rows.sort((rowA, rowB) => {
            const numA = Number(rowA.cells[0].textContent);
            const numB = Number(rowB.cells[0].textContent);
            return numA > numB ? 1 : -1;
        });
        tableBody.append(...rows);
    }

    // 处理搜索功能
    function handleSearch() {
        const keyword = searchInput.value.toLowerCase();
        const rows = Array.from(tableBody.rows);
        rows.forEach(row => {
            const title = row.cells[1].textContent.toLowerCase();
            const isVisible = title.includes(keyword);
            row.style.display = isVisible ? 'table-row' : 'none';
        });
    }

    // 设置事件监听器
    searchInput.addEventListener('input', handleSearch);
    sortTableByFirstColumn();
</script>
</body>
</html>
