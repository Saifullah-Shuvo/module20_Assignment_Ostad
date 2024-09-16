<h1>Create Contact</h1>

<form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="phone">Phone:</label>
    <input type="text" name="phone">
    <label for="address">Address:</label>
    <input type="text" name="address">
    <button type="submit">Create</button>
</form>
