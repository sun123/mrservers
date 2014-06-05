<?php $language = get_cookie('language'); ?>
<section class="nav-bg">
  <div class="container">
    <div class="row"> 
    <div class="col-md-8">
      <nav id="nav-wrap">
        <ul id="nav">
              <li><a class="active" href="<?php echo base_url().$language; ?>"><?=lang('nav.home')?></a></li>
              <li><a href="#"><?=lang('nav.about')?></a></li>
              <li><a href="#"><?=lang('nav.hosting')?></a></li>
              <li><a href="#"><?=lang('nav.domain')?></a></li>
              <li><a href="#"><?=lang('nav.support')?></a></li>
              <li><a href="#"><?=lang('nav.contact')?></a></li>
              <li><a href="<?php echo base_url().$language; ?>/invoice"><?=lang('nav.pdf')?></a></li>
        </ul>
      </nav>
      </div>
    </div>
  </div>
</section>