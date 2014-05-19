<div class="row">
  <div class="col-md-4 paulAside">
    <header class="galleryHeader">
      <h1>Paul Cederdorff</h1>
    </header>
    <div>
     <img src="img/Poul Cederdorff.jpg" alt="Paul Cederdorff" class="img-responsive imgPort">
     <h2>Maler, grafiker og skulptør</h2>
     <p>At beskrive denne kunstner i få ord synes umulig; et liv i højeste gear med hensyn til produktioner, 
      projekter, samarbejdsrelationer og rejser i ind- og udland. En flittig, arbejdsom, udfarende kunstner med vilje til handling.</p>
    </div>
  </div>
  <div class="col-md-8 paulGallery">
    <div class="previews" data-ng-controller="imageGalleryController">
      <div class="ng-cloak">
        <div data-ng-repeat="file in queue | orderBy:'created_at':true" data-ng-class="{'processing': file.$processing()}">
          <div data-ng-switch data-on="!!file.thumbnailUrl">
            <div class="preview" data-ng-switch-when="true">
              <a data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery><img data-ng-src="{{file.thumbnailUrl}}" alt=""></a>
            </div>
            <div class="preview" data-ng-switch-default data-file-upload-preview="file"></div>
          </div>
          <div>
            <p class="name" data-ng-switch data-on="!!file.url">
              <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                <a data-ng-switch-when="true" data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery></a>
                <a data-ng-switch-default data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}"></a>
              </span>
              <span data-ng-switch-default>{{file.name}}</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- The blueimp Gallery widget -->
  <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
  </div>
</div>