<ul class="nav nav-sidebar">
	<li class="{{ $pageName == 'dashboard' ? 'active' : ''}}">
		<a href="/">Dashboard</a>
	</li>
	<li class="{{ $pageName == 'importer' ? 'active' : ''}}">
		<a href="/importer">Importer</a>
	</li>
	<li class="{{ $pageName == 'lists' ? 'active' : ''}}">
    	<a href="/lists">Lists</a>
   	</li>
    <li class="{{ $pageName == 'subscribers' ? 'active' : ''}}">
    	<a href="/subscribers">Subscribers</a>
    </li>
</ul>