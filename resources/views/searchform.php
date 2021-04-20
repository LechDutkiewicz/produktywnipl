<?php
echo '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
    <label>
        <span class="screen-reader-text">' . esc_html__( 'Szukaj:', 'produktywni' ) . '</span>
        <input type="search" class="search-field" placeholder="' . esc_attr__( 'Wpisz szukaną frazę', 'produktywni' ) . '" value="' . get_search_query() . '" name="s" />
        <i class="icon ion-ios-search-strong"></i>
    </label>
    <button type="submit" class="search-submit">
      <i class="zmdi zmdi-search"></i>
    </button>
</form>';
