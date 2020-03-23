<?php include '../view/header.php'; ?>


<main>

<div class="sidenav">

<?php foreach($categories as $category) { ?>
  <a href="/DnA/decision_help?category_id=<?php echo $category->getId()?>"><?php echo $category->getName();?></a>
<?php } ?>
</div>
</main>
<?php include '../view/footer.php'; ?>