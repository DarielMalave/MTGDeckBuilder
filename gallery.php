<?php 
    require_once('templates/header.php');
    require_once('functions.php');
    $mysqli = db_iconnect("mtg");
    $all_cards = array();
    $query = "SELECT * FROM cards LIMIT 0, 4;";
    $result = $mysqli->query($query) or die($mysqli->error);
    $i = 0;
    while($row = $result->fetch_assoc()) {
        $all_cards[$i] = $row;
        $i ++;
    }
    // echo "<pre>";
    // print_r($all_cards);
    // echo "</pre>";
    // $js_array = json_encode($all_cards);
    // echo "let all_cards = ". $js_array . ";\n";
?>

<script>
    $(document).ready(function() {
        let cardCount = 0;

        $.ajax({
            type: "POST",
            url: "process.php",
            data: {cardCountUpdated: cardCount},
            success: function(response) {
                let updated_data_source = JSON.parse(decodeURIComponent(response));
                displayList(updated_data_source, data_container, rows_per_page, cardCount);
            }
        });

        $("#updateButton").click(function(e) {
            cardCount += 4;
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "process.php",
                data: {cardCountUpdated: cardCount},
                success: function(response) {
                    let updated_data_source = JSON.parse(decodeURIComponent(response));
                    displayList(updated_data_source, data_container, rows_per_page, cardCount);
                }
            });
        });
    });

    // window.addEventListener('load', (event) => {
    //     console.log('page is fully loaded');
    //     displayList(data_source, data_container, rows_per_page, 1);
    // });
</script>

<section id="card_container"></section>
<section id="pagination_bar"></section>

<button id="updateButton">Show more!</button>

<script>
    let data_source = JSON.parse(
        decodeURIComponent(
            "<?=rawurlencode(json_encode($all_cards));?>"
        )
    );
    //console.log(data_source);
const data_container = document.getElementById('card_container');
const pagination_bar = document.getElementById('pagination_bar');

let current_page = 1;
let rows_per_page = 4;

function displayList(data_source, wrapper, rows_per_page, page) {
  wrapper.innerHTML = "";
  page --;

  let start = rows_per_page * page;
  let end = start + rows_per_page;
  for (let i = 0; i < rows_per_page; i++) {
    let card_element = document.createElement('div');
    let card_image = document.createElement('img');
    card_image.src = data_source[i]['imageUrl'];
    card_element.appendChild(card_image);
    wrapper.appendChild(card_element);
  }
}

// inside AJAX call here?
//displayList(data_source, data_container, rows_per_page, current_page);

</script>

<?php require_once('templates/footer.php'); ?>