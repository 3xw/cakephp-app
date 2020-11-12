<title>
  <?= !empty($title)? $title: 'WGR APP' ?>
</title>

<!-- IDS -->
<?php if(!empty($googleId)): ?>
  <meta name="google-site-verification" content="xxx" />
<?php endif; ?>

<?php if(!empty($fbId)): ?>
  <meta property="fb:app_id"            content="xxx" />
<?php endif; ?>

<!-- CLASSIC -->
<meta name="viewport"                 content="width=device-width, initial-scale=1.0">
<meta name="author"                   content="<?= !empty($author)? $author : 'WGR SA' ?>">
<meta name="description"              content="<?= !empty($description)? $description : '' ?>">

<!-- OG -->
<meta property="og:type"              content="<?= $this->request->getAttribute('params')['controller'] == 'Posts'? 'article' : 'website' ?>" />
<meta property="og:url"               content="<?= $fullBase ?>" />
<meta property="og:title"             content="<?= !empty($title)? $title: 'WGR APP' ?>" />
<meta property="og:description"       content="<?= !empty($description)? $description : '' ?>" />
<meta property="og:image"             content="<?= empty($image)? $fullBase.'img/front/fb-bann.png' : $this->Attachment->fullPath($image) ?>" />
