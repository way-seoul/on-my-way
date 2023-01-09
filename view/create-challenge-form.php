<form action="../on-my-way/index.php?action=create-challenge" method="post">
    <input name="name" type="text" placeholder="Place Name" required>
    <input name="conditions" type="text" placeholder="Conditions" required>
    <input name="score" type="text" placeholder="Score" required>
    <select name="place_id" id="">
        <option value="">Place A</option>
        <option value="">Place B</option>
        <option value="">Place C</option>
    </select>
    <button type="submit">Add New Place</button>
</form>