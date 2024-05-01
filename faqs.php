<?php 
session_start();
require_once('php/connect.php');

//FAQS
$sql_f = "SELECT * FROM faqs LIMIT 1";
$result_f = mysqli_query($conn, $sql_f);
$rows_f = []; // Initialize an empty array
if($result_f){
    while($row = mysqli_fetch_assoc($result_f)){ // Fetch each row and add to the array
        $rows_f[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}


//QUESTION AND ANSWER
$sql = "SELECT * FROM qa_lists";
$result = mysqli_query($conn, $sql);
$rows = []; // Initialize an empty array
if($result){
    while($row = mysqli_fetch_assoc($result)){ // Fetch each row and add to the array
        $rows[] = $row;
    }
}else{
    echo "Error executing the query: " . mysqli_error($conn);
}


?>

<?php require('./layout/header.php') ?>

<div class="container">
    <div class="p-5 text-center rounded-3 mt-5">
        <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Frequently Asked Questions</h1>
        <hr class="featurette-divider" />
    </div>
</div>

<?php foreach($rows_f as $faq_row):?>
<div class="bg-kabarkadogs-2 marketing">
    <div class="container">
        <div class="row featurette">
            <div class="col-12">
                <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
                    <?php echo $faq_row['title']?>
                </h2>
                <p class="lead color-kabarkadogs pt-5" style="text-align: justify !important;">
                    <?php echo $faq_row['title_description']?>
                </p>
            </div>
            <hr class="featurette-divider" />
        </div>
    </div>
</div>

<div class="bg-kabarkadogs marketing">
    <div class="container">
        <div class="row featurette">
            <div class="col-md-6">
                <div class="accordion" id="faqAccordion">
                    <?php foreach($rows as $qa_row):?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $qa_row['id']?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $qa_row['id']?>">
                                <?php echo $qa_row['question']?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $qa_row['id']?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo $qa_row['id']?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?php echo $qa_row['answer']?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Assuming you want to display an image related to the FAQ -->
                <!-- Make sure to adjust this part according to your data structure -->
                <img src="uploads/<?php echo $faq_row['img']?>" alt="no image" width="99%" height="99%">
            </div>
        </div>
        <hr class="featurette-divider" />
    </div>
</div>
<?php endforeach ?>

<?php require('./layout/footer.php')?>
