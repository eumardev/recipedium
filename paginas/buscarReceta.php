    <div class="container">
        <h2>Buscador de Recetas en Internet</h2>
        <div class="search-container">
            <label for="search" class="">Buscador de recetas</label>
            <input type="text" id="search" placeholder="Buscar receta por ingrediente...">
            <button id="searchButton" class="btn">Buscar</button>
        </div>
        <div id="recetas"></div>
    </div>

    <script>
        document.getElementById('searchButton').addEventListener('click', buscarRecetas);

        async function buscarRecetas() {
            // obtengo el valor introducido por el usuario y construyo la url completa siguiendo los pasos de la API de Spoonacular
            const query = document.getElementById('search').value.trim();
            const apiKey = 'e83e07cf7c294fea9302ef4915c54397'; 
            const url = `https://api.spoonacular.com/recipes/complexSearch?query=${query}&apiKey=${apiKey}`;

            const recetasDiv = document.getElementById('recetas');
            recetasDiv.innerHTML = ''; 

            if (!query) {
                recetasDiv.innerHTML = '<p>Por favor, ingrese un ingrediente para buscar recetas.</p>';
                return;
            }

            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Error en la respuesta de la API');
                }
                const data = await response.json();
                mostrarRecetas(data.results);
            } catch (error) {
                console.error('Error al obtener las recetas:', error);
                recetasDiv.innerHTML = '<p>Error al obtener las recetas. Por favor, intente nuevamente.</p>';
            }
        }

        async function mostrarRecetas(recetas) {
            const recetasDiv = document.getElementById('recetas');
            recetasDiv.innerHTML = ''; 

            if (recetas.length === 0) {
                recetasDiv.innerHTML = '<p>No se encontraron recetas. Intenta buscar por ingrediente en inglés.</p>';
                return;
            }

            for (const receta of recetas) {
                const recetaDiv = document.createElement('div');
                recetaDiv.classList.add('receta-item');
                recetaDiv.innerHTML = `
                    <div class="receta-titulo"><h3>${receta.title}</h3></div>
                    <div class="receta-contenido">
                        <div class="receta-imagen">
                            <img src="${receta.image}" alt="${receta.title}">
                        </div>
                        <div class="receta-data">
                            <p>Cargando ingredientes e instrucciones...</p>
                        </div>
                    </div>
                `;
                recetasDiv.appendChild(recetaDiv);

                // Obtengo los detalles de la receta
                const apiKey = 'e83e07cf7c294fea9302ef4915c54397'; 
                const url = `https://api.spoonacular.com/recipes/${receta.id}/information?apiKey=${apiKey}`;

                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la API');
                    }
                    const data = await response.json();
                    const ingredientes = data.extendedIngredients.map(ing => ing.original).join(', ') || 'No hay ingredientes disponibles.';
                    const instrucciones = data.instructions || 'No hay instrucciones disponibles.';
                    recetaDiv.querySelector('.receta-data').innerHTML = `
                        <p><strong>Ingredientes:</strong> ${ingredientes}</p>
                        <p><strong>Instrucciones:</strong> ${instrucciones}</p>
                    `;
                } catch (error) {
                    console.error('Error al obtener los detalles de la receta:', error);
                    recetaDiv.querySelector('.receta-data').innerHTML = '<p>Error al obtener los detalles de la receta.</p>';
                }
            }
        }
    </script>
