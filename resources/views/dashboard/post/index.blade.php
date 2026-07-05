<table>
    <thead>
        <tr>
            <td>
                Id
            </td>
            <td>
                Title
            </td>
            <td>
                Posted
            </td>
            <td>
                Category
            </td>
        </tr>
    </thead>
<tbody>
    @foreach ($posts as $p)
    <tr>
        <td>
            {{ $p->id }}
        </td>
        <td>
            {{ $p->title }}
        </td>
        <td>
            {{ $p->posted }}
        </td>
        <td>
            {{ $p->category->title }}
        </td>
    </tr>
    @endforeach
</tbody>