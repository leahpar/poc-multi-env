# POC Multi environnements

POC d'une seule installation de Symfony avec plusieurs environnements.

3 environnements gérés en natif : dev, test, prod

## Création nouvel environnement `toto`

### Variable globale

```
export APP_ENV=toto 
```

### Fichier de paramétrage local

```
vi .env.toto.local
```

### Chargement des bundles

Modifier le fichier `config/bundles.php` pour charger ou non les différents bundles.

Note : si c'est un environnement de prod, rien à faire à priori.

Ce fichier retourne un tableau des bundles à activer ou non selon l'environnement, exécuté dans MicroKernelTrait.
Accès au Kernel en train de booter :
```
$this = App\Kernel {
  #bundles: []
  #container: null
  #environment: "toto" <== si besoin
  #debug: true
  #booted: false
  #startTime: 1596702191.354
  -projectDir: "/Users/raphael/projets/stim/poc-multi-env"
  -warmupDir: null
  -requestStackSize: 0
  -resetServices: false
}
```

### Fichiers de config

```
mkdir config/toto
```

Pour partir de la config de dev :
```
echo "imports: [{ resource: '../dev/' }]" > config/toto/_default.yaml
```

Pour partir de la config de prod :
```
echo "imports: [{ resource: '../prod/' }]" > config/toto/_default.yaml
```

Puis créer des fichiers dans `config/toto` si besoin de modifier/ajouter une config par rapport aux valeur par défaut.

Ordre de chargement des fichiers de configuration, chacun surcharge le précédent :

1. config/packages/*.yaml           <== config générique & valeurs par défaut
2. config/packages/<env>/*.yaml     <== config spécifique
3. config/services.yaml             <== ⚠️ écrase les valeurs des environnements

https://symfony.com/doc/current/configuration.html#configuration-environments


Pour voir la config actuelle de l'environnement :
```
# APP_ENV=toto
sf debug:config 
```


### Routes

Si nécessaire (si utisation du web profiler, donc en mode dev)
```
ln -s dev config/routes/toto
```

Pas de config de route spécifique si pas mode dev... 

### cache

Le cache est dans `var/cache/toto`

```
# APP_ENV=toto
sf clear:cache 
```

### Logs

Les logs sont dans `var/log/toto.log`


## Services

### SomeService

Interface `SomeServiceInterface` pour déclarer le service.

Interface "autowirée" dans le controleur : `public function index(SomeServiceInterface $service)`

Plusieurs classes réelles implémentent cette interface :
- `FixedService` 
- `RandomService` 
- `NullService` 

```yaml
# config/config.yml

services:
    # (facultatif) Valeur par défaut (ou non) pour l'interface
    App\SomeService\SomeServiceInterface: ~
```

```yaml
# config/toto/config.yml

services:
    # Déclaration du service réel qui surchagera la valeur par défaut
    App\SomeService\SomeServiceInterface: '@App\SomeService\FixedService'
```