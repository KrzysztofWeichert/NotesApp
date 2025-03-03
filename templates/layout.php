<html>

<head>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="message">
        <?php
        if (!empty($params['info'])) {
            $infoMessage = match ($params['info']) {
                'edited' => 'Note has been edited!',
                'created' => 'Note has been created!',
                'deleted' => 'Note has been deleted!',
                default => 'Something went wrong!'
            };
            echo "<p>$infoMessage</p>";
        }
        ?>
    </div>
    <header>
        <h1>
            NotesApp
        </h1>

    </header>

    <main>
        <aside>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/?action=create">Create note</a>
                </li>
            </ul>
        </aside>

        <?php
        require_once("templates/pages/$page.php");
        ?>

    </main>

    <footer>
        <p>Krzysztof Weichert</p>
    </footer>
</body>

</html>