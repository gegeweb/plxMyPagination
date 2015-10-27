<h2>Help</h2>
<h3>Static Pages</h3>
<p>
Add this following line in your theme (ex file static.php) where you want to dispay the paging&nbsp;:
</p>
<pre style="font-size:12px; padding-left:40px">
&lt;?php eval($plxShow->callHook('staticPagination')) ?&gt;
</pre>
<h3>Articles Pages</h3>
<p>
Add this following line in your theme (home.php) if not present where you want to display the paging&nbsp;:
<pre style="font-size:12px; padding-left:40px">
&lt;div id="pagination"&gt;
&lt;?php $plxShow->pagination(); ?&gt;
&lt;/div&gt;
</pre>
</p>
<h3>Styles</h3>
<p>If not present in your header.php, add this following line&nbsp;:</p>
<pre style="font-size:12px; padding-left:40px">
&lt?php $plxShow->pluginsCss() ?&gt;
</pre>
