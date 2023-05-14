<ul class="list-group">

    <?php $results = getCategories(); while($category = mysqli_fetch_assoc($results)): ?>

        <li class="list-group-item">
            <a href="<?php echo "movies/".$category["id"] ?>"><?php echo $category["name"] ?></a>
            
        </li>

    <?php endwhile; ?>

</ul>

        
