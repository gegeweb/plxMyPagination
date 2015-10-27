# plxMyPagination
### Plugin qui améliore la pagination de [pluXML](http://pluxml.org) et ajoute une pagination aux groupes de pages statiques.

---

#### Dependances  : 
* [Font Awesome](http://fontawesome.io/), un plugin pluXML existe :  [plxFontAwesome](http://forum.pluxml.org/viewtopic.php?id=5256).

#### Usage

##### Pages statiques

Ajoutez la ligne suivante dans votre thème (ex fichier static.php) à l'endroit où vous voulez afficher la pagination : 

```php
<?php eval($plxShow->callHook('staticPagination')) ?>
```

#### Pages du Journal

Ajoutez la ligne suivante dans votre thème (home.php), si pas présente, à l'endroit où vous voulez afficher la pagination : 

```php
<div id="pagination">
  <?php $plxShow->pagination(); ?>
</div>
```
#### Styles

Ajoutez la ligne suivante dans le header.php si absente pour charger les styles du plugin :

```php
<?php $plxShow->pluginsCss() ?>
```
 L'affichage peut être modifié dans la feuille de style du plugin (ou du thème) en modifiant les classes css suivantes.

* div#pagination : &lt;div&gt; contenant la pagination
* ul.pagination li : Éléments du pageur
* ul.pagination li .pagenav : Éléments de la pagination
* .p_first : Première page
* .p_prev : Page précédente
* .p_current : Page courante
* .p_next : Page suivante
* .p_last : Dernière page
* .p_pager : Nombre de pages




