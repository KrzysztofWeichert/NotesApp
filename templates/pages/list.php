    <section>

        <h2>Notes list:</h2>
        <?php
       /*  dumper($params); */
        $searchText = $params['searchtext'];
        $sortBy = $params['sort']['by'];
        $sortOrder = $params['sort']['order'];
        $pageSize = $params['page']['size'];
        $CurrentPage = $params['page']['number'];
        $pageAllCount = $params['page']['pages'];

        ?>
        <form action="/" method="get">
            <label>Sort by: </label>

            <select name="sortby">
                <option value="title" <?php echo $sortBy === 'title' ? 'selected' : '' ?>>Title</option>
                <option value="date" <?php echo $sortBy === 'date' ? 'selected' : '' ?>>Date</option>
            </select>
            <br>
            <label>Sort direction</label>
            <select name="sortorder">
                <option value="asc" <?php echo $sortOrder === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?php echo $sortOrder === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
            <br>
            <label>Listing size</label>
            <select name="pagesize">
                <option value="1" <?php echo (int) $pageSize == 1 ? 'selected' : '' ?>>1</option>
                <option value="5" <?php echo (int) $pageSize == 5 ? 'selected' : '' ?>>5</option>
                <option value="10" <?php echo (int) $pageSize == 10 ? 'selected' : '' ?>>10</option>
            </select>
            <br>
            <input type="text" name="searchtext" value="<?php echo $searchText ?>">
            <br>
            <input type="submit" value="Sort" class="search-btn">


        </form>
  <!--       <form action="/" method="get">
            <input type="text" name="searchtext" id="">
            <input type="submit" value="Szukaj">
        </form> -->
        

        
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Data</th>
                <th>Options</th>
            </tr>

            <?php
            if (!empty($params['notes'])):
                foreach ($params['notes'] ?? [] as $note):
            ?>

                    <tr>
                        <td> <?php echo $note['id'] ?></td>
                        <td><?php echo $note['title'] ?></td>
                        <td><?php echo $note['date'] ?></td>

                        <td class='table-options'>
                            <a href="?action=show&id=<?php echo $note['id'] ?>"><button class="details-btn">Details</button></a>
                            <a href="?action=delete&id=<?php echo $note['id'] ?>"><button class="details-btn">Delete</button></a>
                        </td>
                    </tr>
            <?php
                endforeach;
            else :
                echo '<p>Brak notatek do wyświetlenia</p>';
            endif;
            ?>

        </table>
        <strong><?php echo $params['resultList'] ?? ''; ?></strong>
        <div class="pagination">
            <?php
            $paginationURL = "&sortby=$sortBy&sortorder=$sortOrder&pagesize=$pageSize&searchtext=$searchText";

            if ($CurrentPage  > 1): ?>
                <a href="/?page=<?php echo $CurrentPage  + -1 . $paginationURL ?>"><<</a>
            <?php endif;

            for ($i = 1; $i <= $pageAllCount; $i++):
            ?>
                <a href="/?page=<?php echo $i . $paginationURL ?>"><?php echo $i ?></a>
            <?php
            endfor;

            if ($CurrentPage  < $pageAllCount): ?>
                <a href="/?page=<?php echo $CurrentPage  + 1 . $paginationURL ?>">>></a>
            <?php endif ?>
        </div>

    </section>