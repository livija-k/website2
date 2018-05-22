    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <?php
          include_once 'db.php';
          include_once 'utils.php';

          if ($result = $conn->query("SELECT * FROM menu_items ORDER BY `order` ASC")) {
            //     printf("Select returned %d rows.\n", $result->num_rows);
            if ($result->num_rows > 0)
            {
              while ($row = $result->fetch_assoc())
              {
                echo '<li class="nav-item"><a class="nav-link" href="'.getValueOr($row["link"]).'" title="'.getValueOr($row["hint"]).'">'.getValueOr($row["title"]).'</a></li>';
              }
            }
            /* free result set */
            $result->close();
          }
          ?>
<!--           <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
        <?php
          $username = getCurrentUsername($conn);
        
          if (!is_null($username))
            echo $username;
          else
            echo '<a href="login.php" class="btn btn-outline-success my-2 my-sm-0">Login</a>';
        ?>
           

      </div>
    </nav>