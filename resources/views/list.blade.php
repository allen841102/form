<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>Form Table</h2>

<table>
    <tr>
        <th>No.</th>
        <th>Creation Time</th>
    </tr>

    @foreach ($list as $item)
    <tr>
        <td>
            <a href="{{ route('form.show', ['id' => $item->id]) }}"> {{ $item->id }} </a>
        </td>
        <td>{{ $item->created_at }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
