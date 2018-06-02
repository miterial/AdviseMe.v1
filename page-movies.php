 <?php 
 	/*
    Template Name: Фильтр
    */
 get_header(); ?> 
<div class="filter">
      <h1 class="text-center py-3">НАЙТИ ФИЛЬМ</h1>
      <div class="filter--settings">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-xs-12">
              <div class="sliders" id="regular-slider"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-s-12">
              <h2>Жанры</h2>
              <ul class="toggles">
                <?php
                  $conn = db_connect();
                  if($conn != null) {
                    $genresToPrint = get_genres($conn); 
                    for($i = 0; $i < count($genresToPrint); $i++) { ?>
                    <li>
                      <input class="tgl-skewed" type="checkbox" name="movie" id="inp-adventures" value="<?php echo $row["id"] ?>" data-toggle="toggle"/>
                      <label class="tgl-btn" for="inp-adventures"><?php echo $genresToPrint[$i] ?></label>
                    </li>
                    
                    <?php }
                    //Добавление постов
                    $movie = get_movies_full($conn, true); 
                    $conn->close();
                  }
                ?>
              </ul>
              <h2>Страны</h2>
              <ul class="toggles">
                <?php
                  $conn = db_connect();
                  if($conn != null) {
                    $genresToPrint = get_countries($conn); 
                    for($i = 0; $i < count($genresToPrint); $i++) { ?>
                    <li>
                      <input class="tgl-skewed" type="checkbox" name="movie" id="inp-adventures" value="<?php echo $row["id"] ?>" data-toggle="toggle"/>
                      <label class="tgl-btn" for="inp-adventures"><?php echo $genresToPrint[$i] ?></label>
                    </li>
                    
                    <?php }
                    //Добавление постов
                    $conn->close();
                  }
                ?>
              </ul>
            </div>
            <div class="col-lg-6 col-xs-12">
              <h2>Минимальная оценка</h2>
              <div class="row">
                <div class="col-lg-3 col-sm-2">
                  <p>IMDB</p>
                </div>
                <div class="col-lg-8 col-sm-9">
                  <div class="sliders" id="rate-slider1"></div>
                </div>
                <div class="col-lg-1 col-sm-1">
                  <p id="rate-text1">0.0</p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-2 col-sm-3">
                  <p>Кинопоиск</p>
                </div>
                <div class="col-lg-8 col-md-9 col-sm-7">
                  <div class="sliders" id="rate-slider2"></div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2">
                  <p id="rate-text2">0.0</p>  
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-sm-2">
                  <p>AdviseMe</p>
                </div>
                <div class="col-lg-8 col-sm-9">
                  <div class="sliders" id="rate-slider3"></div>
                </div>
                <div class="col-lg-1 col-sm-1">
                  <p id="rate-text3">0.0</p>
                </div>
              </div>
              <div class="row">
                <div class="col-auto">
                  <button class="light-button">Сбросить фильтр</button>
                </div>
                <div class="col-auto">
                  <button class="light-button">Начать поиск</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h1 class="text-center py-3">Рекомендованные фильмы</h1>
    <div class="filtered-movies container">
      <div class="d-flex flex-wrap text-center">
      <?php
              $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
              $params = array(
                'posts_per_page' => 18, // количество постов на странице
                'paged'           => $current_page // текущая страница
              );
              query_posts($params);
           
          $wp_query->is_archive = true;
          $wp_query->is_home = false;
          if ( have_posts() ) : ?>
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post(); ?>

              <div class="filtered-movies--item">
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_field('poster_m'); ?>" alt="movie" width="150px" style='height: 210px'/>
                  <div class="text-center">
                    <p><?php the_title()?></p>
                  </div>
                </a>
              </div>

            <?php endwhile; ?>
    <?php 

      the_posts_pagination( array(
        'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
        'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
      ) );

    else :

      get_template_part( 'template-parts/post/content', 'none' );

    endif; ?>
      </div>
    </div>

<?php get_footer(); ?>