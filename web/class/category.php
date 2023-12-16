<?php
class Category
{
    private $koneksi;

    function __construct($connection)
    {
        $this->koneksi = $connection;
    }

    function fetchCategory()
    {
        $query = "SELECT category_name FROM category";
        $result = mysqli_query($this->koneksi, $query);
        if ($result) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data; // Return the fetched data
        } else {
            return null; // Return null if query execution fails
        }
    }

    function showAllCategoryRadio($row)
    {
        $categories = $this->fetchCategory();
        foreach ($categories as $index => $row) {
            $isChecked = ($index == 0) ? 'checked' : '';
            echo '<input type="radio" 
                        name="category_id" 
                        id="' .  ($index + 1) . '" 
                        value="' .  ($index + 1) . '" 
                        class="category-option" ' .
                $isChecked  . '>
                <label for="' . ($index + 1) . '" class="category-label">' .
                $row['category_name'] . '
                </label>';
        }
    }

    function showSelectedCategoryRadio($row, $id)
    {
        $categories = $this->fetchCategory();
        foreach ($categories as $index => $row) {
            $isChecked = (($index + 1) == $id) ? 'checked' : '';
            echo '<input type="radio" 
                        name="category" 
                        id="' .  ($index + 1) . '" 
                        class="category-option" ' .
                $isChecked  . '>
                <label for="' . ($index + 1) . '" class="category-label">' .
                $row['category_name'] . '
                </label>';
        }
    }
}
