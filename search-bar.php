
<div class="search">
    <form action="posts.php" method="get" class="filter">
        <label for="tag" class="filter__label">Ricerca per tag</label>
        <div class="autocomplete">
            <input name="tag" type="text" list="tag" id="filter__tag" class="filter__tag" autocomplete="off" placeholder="Ricerca per tag">
            <datalist id="tag" class="autocomplete__suggestions">
            </datalist>
        </div>

     </form>
</div>