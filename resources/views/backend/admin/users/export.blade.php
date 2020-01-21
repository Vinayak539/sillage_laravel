<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Provider</th>
        <th>Provider ID</th>
        <th>Image Path</th>
        <th>User Status</th>
        <th>Register On</th>
    </tr>
    </thead>
    <tbody>
    <tr></tr>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->provider }}</td>
            <td>{{ $user->provider_id }}</td>
            <td>{{ $user->image_url }}</td>
            <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
            <td>{{ date('d-M-Y h:i A', strtotime($user->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
