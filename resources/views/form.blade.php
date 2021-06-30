<form action="{{ route('form.handle') }}" method="post">
    @csrf
    <!-- csrf token for post forms -->
    <div>
        <label for="name">Enter name:</label>
        <input type="text" id="name" name="name" required autofocus/>
    </div>
    <button>Save</button>
</form>
