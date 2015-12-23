<?php

  include('includes/init.php');
  include('includes/header.php');

?>

    <section class="page-wrap">
        <?php if (isset($errorMessage) && !empty($errorMessage)) {
            print "<p class='error-message'>$errorMessage <span class='error-message-close'>X</span></p>";
        }

        // var_dump($_SESSION);
        $loggedIn = $_SESSION['LoggedIn']; ?>

        <form class="media-submit-form" method="post" action="validate.php">
            <fieldset class="fieldset-add-title">
                <div class="field-media-title">
                    <label class="label-media-title" for="media-title">Search for a movie title</label>
                    <input type="text" name="media-title" id="media-title" autofocus autocomplete="off">
                    <div class="suggestion">
                        <div class="suggestion-strip"></div>
                        <a href="#" class="clear-search">Clear</a>
                        <div class="ajax-content"></div>
                        <?php if(!empty($loggedIn)) { ?>
                        <div class="media-type-checkboxes cf">
                            <div class="media-type-wrap">
                                <input type="radio" name="media-type" value="bluray" id="radio-media-type-bluray" checked="checked">
                                <label for="radio-media-type-bluray">Blu-ray</label>
                            </div>
                            <div class="media-type-wrap">
                                <input type="radio" name="media-type" value="dvd" id="radio-media-type-dvd">
                                <label for="radio-media-type-dvd">DVD</label>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <input type="button" id="search-button" value="Search">
                </div>
                <div class="field-media-year">
                    <label class="label-media-year" for="media-year">Year of release</label>
                    <select id="media-year" name="media-year">
                        <option value="">Please select</option>
                        <?php generateYearOptions(50) ?>
                    </select>
                </div>
                <?php if(!empty($loggedIn)) { ?>
                <input type="text" name="media-imdbid" id="media-imdbid" class="hidden">
                <button type="submit" name="update" value="add"><i class="fa fa-plus-circle">Add</i></button>
                <?php } ?>
            </fieldset>
            <?php if(!empty($loggedIn)) { ?>
            <ul class="dvd-list">
                <?php
                foreach ($mediaList as $media) {
                    $mediaID          = $media['id'];
                    $mediaTitle       = $media['title'];
                    $mediaYear        = $media['year'];
                    $mediaPlot        = $media['plot'];
                    $mediaPoster      = $media['posterURL'];
                    $mediaDirector    = $media['director'];
                    $mediaGenre       = $media['genre'];
                    $mediaType        = $media['media_type'];

                    ?>
                  <li id="media-<?php print $mediaID; ?>" class="media-item cf">
                      <p class="media-item-title-year">
                          <a href="#" class="js-toggle-media-details">
                            <span class="media-item-title"><?php print $mediaTitle; ?></span>  <span class="media-item-year">(<?php print $mediaYear; ?>)</span>
                          </a>
                      </p>
                      <div class="media-item-edit">
                          <a href="#" class="media-item-detail-toggle js-toggle-media-details">Details</a>
                          <input type="checkbox" name="delete[<?php print $mediaID; ?>]" class="delete-item" id="delete[<?php print $mediaID; ?>]">
                          <label for="delete[<?php print $mediaID; ?>]"><i class="fa fa-trash-o"></i></label>
                      </div>
                      <div class="media-item-detail">
                          <div class="media-item-detail-poster">
                              <img src="<?php print $mediaPoster; ?>" class="media-item-poster-img">
                          </div>
                          <div class="media-item-detail-meta">
                              <div class="media-item-plot">
                                  <p><?php print $mediaPlot; ?></p>
                              </div>
                              <p class="media-item-director">
                                  <strong>Directed by:</strong> <span><?php print $mediaDirector; ?></span>
                              </p>
                              <p class="media-item-genre">
                                  <strong>Genre:</strong> <span><?php print $mediaGenre; ?></span>
                              </p>
                              <p class="media-item-type">
                                  <strong>Media:</strong> <span><?php print $mediaType; ?></span>
                              </p>
                              </div>
                              <!-- TODO: add more details -->
                          </div>
                      </div>
                  </li>
                <?php } ?>
            </ul>
            <button type="submit" name="update" value="delete" class="submit-delete"><i class="fa fa-trash-o"></i>Delete</button>
            <div class="total-count">
                <p><strong>Total:</strong> <?php print count($mediaList); ?></p>
            </div>
            <div class="check-all">
                <input type="checkbox" id="check-all-delete">
                <label for="check-all-delete" disabled="true">Check all</label>
            </div>
            <?php } ?>

        </form>

  <?php include('includes/footer.php'); ?>
