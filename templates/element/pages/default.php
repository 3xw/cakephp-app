<cms-page :id="1">

  <template v-slot:sections>
    <?= $this->element('sections/default', ['ref' => []]) ?>
  </template>

  <template v-slot:content>
    <div class="container">
      <h1>Default Page</h1>
      <?php foreach ($page->sections as $section) echo $this->element('sections/'.$section->section_template); ?>
    </div>
  </template>

</cms-page>
