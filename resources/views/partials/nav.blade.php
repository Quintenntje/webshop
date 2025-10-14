<header class="header">
  <div class="container header__items mobile-only">
    <div class="header__items__left">
      <button id="menu-open" aria-label="Menu" class="btn btn--transparent header__items__left__button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu"><path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/></svg>
      </button>
      <a href="/search" class="link link--nav header__items__left__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
      </a>
      <a href="account" class="link link--nav header__items__left__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </a>
    </div>
    <div class="header__items__center">
        <a href="/" class="link link--nav header__items__center__logo">
            <img class="nav__logo" src="{{ asset('images/logo/coolKickslogo.png') }}" alt="Logo" >
        </a>
    </div>
    <div class="header__items__right">
        <a href="/cart" class="link link--nav nav__items__right__button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handbag-icon lucide-handbag"><path d="M2.048 18.566A2 2 0 0 0 4 21h16a2 2 0 0 0 1.952-2.434l-2-9A2 2 0 0 0 18 8H6a2 2 0 0 0-1.952 1.566z"/><path d="M8 11V6a4 4 0 0 1 8 0v5"/></svg>
        </a>
  </div>
</div>
<div class="container header__items pc-only">

  <div class="header__items__left">
    <a href="/" class="link link--nav header__items__center__logo">
      <img class="nav__logo" src="{{ asset('images/logo/coolKickslogo.png') }}" alt="Logo" >
  </a>
    </div>
    <nav class="header__items__center">
      <ul class="nav__items">
        <li class="nav__item">
          <a href="/shop" class="link link--nav nav__item__link">Shop</a>
        </li>
        <li class="nav__item">
          <a href="/shoes/men" class="link link--nav nav__item__link {{ request()->is('shoes/men') ? 'active' : '' }}">Men</a>
        </li>
        <li class="nav__item">
          <a href="/shoes/women" class="link link--nav nav__item__link {{ request()->is('shoes/women') ? 'active' : '' }}">Women</a>
        </li>
       
        <li class="nav__item">
          <a href="/shoes/kids" class="link link--nav nav__item__link {{ request()->is('shoes/kids') ? 'active' : '' }}">Kids</a>
        </li>
        <li class="nav__item">
          <a href="/sale" class="link link--nav nav__item__link">Sale</a>
        </li>
      </ul>
    </nav>
  <div class="header__items__right">
    <a href="/search" class="link link--nav header__items__left__icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
    </a>
    <a href="/account" class="link link--nav header__items__left__icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </a>
    <a href="/cart" class="link link--nav nav__items__right__button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handbag-icon lucide-handbag"><path d="M2.048 18.566A2 2 0 0 0 4 21h16a2 2 0 0 0 1.952-2.434l-2-9A2 2 0 0 0 18 8H6a2 2 0 0 0-1.952 1.566z"/><path d="M8 11V6a4 4 0 0 1 8 0v5"/></svg>
    </a>
  </div>

</header>

<div id="menu-overlay" class="mobile-only mobile-menu__overlay mobile-only" hidden></div>
<nav id="mobile-menu" class="mobile-only mobile-menu mobile-only" aria-hidden="true">
  <div class="mobile-menu__header">
    <button id="menu-close" aria-label="Close menu" class="btn btn--transparent mobile-menu__close">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
    </button>
  </div>
  <ul class="mobile-menu__links">
    <li><a class="link link--nav" href="/shop">Shop</a></li>
    <li><a class="link link--nav {{ request()->is('shoes/men') ? 'active' : '' }}" href="/shoes/men">Men</a></li>
    <li><a class="link link--nav {{ request()->is('shoes/women') ? 'active' : '' }}" href="/shoes/women">Women</a></li>
    <li><a class="link link--nav {{ request()->is('shoes/kids') ? 'active' : '' }}" href="/shoes/kids">Kids</a></li>
    <li><a class="link link--nav" href="/sale">Sale</a></li>
  </ul>
</nav>