<h1><?php echo $blog_heading; ?></h1>
<ul>
<?php foreach($blogs as $blog) : ?>
<li> blog id <?php echo  $blog->id; ?>:
<a href="blog/view/<?php echo $blog->id; ?>"><?php echo $blog->name; ?></a></li>
<?php endforeach; ?>
</ul>
