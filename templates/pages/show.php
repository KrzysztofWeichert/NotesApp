<section>

<h2>Note details</h2>

<table class="note-details">
    <tr>
        <th>
            Title:
        </th>
        <td>
            <?php echo $params['title'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Description:
        </th>
        <td>
            <?php echo $params['description'] ?>
        </td>
    </tr>
    <tr>
        <th>
            Creation date:
        </th>
        <td>
            <?php echo $params['date'] ?>
        </td>
    </tr>
</table>

<a href="/"><button>Back</buttton></a>
<a href="/?action=edit&id=<?php echo $params['id'] ?>"><button>Edit</buttton></a>
</section>