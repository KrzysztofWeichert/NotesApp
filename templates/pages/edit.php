<section>
        <h2>Edit note</h2>
        <form class="add_form" action="/?action=edit&id=<?php echo $params['id']; ?>" method="post">
            <ul>
                <li>
                    <label>Title: <span>*</span></label><br>
                    <input class="add_title" type="text" name="title" id="" value=" <?php echo $params['title']?>">
                </li>
                <li>
                    <label>Description:</label><br>
                    <textarea rows="6" class="add_desc" name="description"><?php echo $params['description']?></textarea>
                </li>
                <li>
                    <input class="add_btn" type="submit" value="Save">
                </li>
            </ul>
        </form>

        
    </section>