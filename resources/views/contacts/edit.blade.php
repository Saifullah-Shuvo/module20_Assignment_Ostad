<h1>Edit Contact</h1>

<form action="{{ route('contacts.update', $contact->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $contact->name }}" required>
    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $contact->email }}" required>
    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="{{ $contact->phone }}">
    <label for="address">Address:</label>
    <input type="text" name="address" value="{{ $contact->address }}">
    <button type="submit">Update</button>
</form>
