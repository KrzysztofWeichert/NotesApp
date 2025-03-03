    <section>
        <h2>Create new note</h2>
        <form class="add_form" action="/?action=create" method="post">
            <ul>
                <li>
                    <label>Note title: <span>*</span></label><br>
                    <input class="add_title" type="text" name="title" id="">
                </li>
                <li>
                    <label>Description:</label><br>
                    <textarea rows="6" class="add_desc" name="description"></textarea>
                </li>
                <li>
                    <input class="add_btn" type="submit" value="Add note">
                </li>
            </ul>
        </form>

    </section>