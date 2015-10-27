<h2>Aide</h2>
<h3>Pages Statiques</h3>
<p>
Ajoutez la ligne suivante dans votre thème (ex fichier static.php) à l'endroit où vous voulez afficher la pagination&nbsp;:
</p>
<pre style="font-size:12px; padding-left:40px">
&lt;?php eval($plxShow->callHook('staticPagination')) ?&gt;
</pre>
<h3>Pages du Journal</h3>
<p>
Ajoutez la ligne suivante dans votre thème (home.php), si pas présente, à l'endroit où vous voulez afficher la pagination&nbsp;:
<pre style="font-size:12px; padding-left:40px">
&lt;div id="pagination"&gt;
&lt;?php $plxShow->pagination(); ?&gt;
&lt;/div&gt;
</pre>
</p>
<h3>Styles</h3>
<p>Ajoutez la ligne suivante dans le header.php si absente&nbsp;:</p>
<pre style="font-size:12px; padding-left:40px">
&lt?php $plxShow->pluginsCss() ?&gt;
</pre>
