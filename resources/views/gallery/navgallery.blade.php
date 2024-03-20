@vite('resources/css/gallerynav.css')
<div class="navigation">
    <input type="checkbox" class="navigation__checkbox" id="nav-toggle">
    <label for="nav-toggle" class="navigation__button">
        <span class="navigation__icon" aria-label="toggle navigation menu"></span>
    </label>
    <div class="navigation__background"></div>

    <nav class="navigation__nav" role="navigation">
        <ul  class="navigation__list">
            <li  class="navigation__item">
                <a href="szuretibalok" class="navigation__link">{{__('navgallery.harvest')}}</a>
            </li>
            <li class="navigation__item">
                <a href="eletkepek" class="navigation__link">{{__('navgallery.life')}}</a>
            </li>
            <li class="navigation__item">
                <a href="falunapok" class="navigation__link">{{__('navgallery.days')}}</a>
            </li>
            <li class="navigation__item">
                <a href="regikepek" class="navigation__link">{{__('navgallery.old')}}</a>
            </li>
        </ul>
    </nav>
</div>
