<template>
  <b-navbar fixed="top" toggleable="lg" type="light" style="light">
    <div class="navbar-header">
      <b-navbar-toggle target="nav-collapse">
        <span class="sr-only">Toggle Navigation</span>
      </b-navbar-toggle>
      
      <!-- Branding Image -->
      <b-navbar-brand to="/">Mehrdraufhaber Productions</b-navbar-brand>
    </div>

    <b-collapse id="navbar-collapse" is-nav>
      <!-- Left Side Of Navbar -->    
       <b-navbar-nav>
        <b-nav-item to="/projects">Projekte</b-nav-item>
        <b-nav-item to="/diary">Tagebuch</b-nav-item>
        <b-nav-item to="/filmliste">Filmliste</b-nav-item>
        <b-nav-item to="/watchlist">Watchlist</b-nav-item>
        <b-nav-item to="/leihliste">Leihliste</b-nav-item>
      </b-navbar-nav>

      <!-- Right Side Of Navbar -->
      <b-navbar-nav class="ml-auto"><!-- Authentication Links -->
        @if (Auth::guest())
        <li>
          <a>Login</a>
        </li>
        <li>
          <a>Register</a>
        </li>@else
        <li class="dropdown">
          <a
            href="#"
            class="dropdown-toggle"
            data-toggle="dropdown"
            role="button"
            aria-expanded="false"
          >
            @NAME
            <span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
            <li>
              <a>
                <i class="fa fa-btn fa-sign-out"></i>Logout
              </a>
            </li>
          </ul>
        </li>@endif
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<style scoped>

   
body {
  text-align: center;
}

form {
  display: flex;
  margin: auto;
  width: 55%;
}

#table {
  display: block;
  align-items: center;
}

#filme {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  width: fixed;
  margin: auto;
  border-collapse: collapse;
  table-layout: fixed;
}

#filme td, #filme th {
  font-size: 1em;
  border: 1px solid darkcyan;
  padding: 3px 7px 2px 7px;
}

#filme th {
  font-size: 1.1em;
  text-align: left;
  padding-top: 5px;
  padding-bottom: 4px;
  background-color: #8a96b8;
  color: #ffffff;
}

#filme tr.alt td {
  color: black;
  background-color: lightgrey;
}

#filme a {
  color: darkblue;
}

.checkbox {
  text-align: right;
}

.namefield{
    width: 100px;
    display: inline-block;
}
.shufflefield{
    width: 50px;
    float: right;
}

fieldset, input {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
fieldset {
    margin:0;
}

.project-box {
  float: left;
  border: 2px solid darkcyan;
  padding: 10px;
  margin: 20px;
}
</style>
