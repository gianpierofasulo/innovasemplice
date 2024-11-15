<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button onclick="loadBreweries()" class="btn btn-primary btn-block btn-lg">Visualizza birrifici</button>

                    <h3 id="message" style="display:none; color:red">Attendi caricamento....</h3>
                    <div id="breweriesSection" style="display:none;">
                        <h2>Lista di Birrifici</h2>

                        <table id="breweryTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Città</th>
                                    <th>Stato</th>
                                    <th>Website</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Le righe saranno aggiunte dinamicamente -->
                            </tbody>
                            <tr id="paginationRow">
                                <!-- Paginazione generata dinamicamente -->
                            </div>

                        </table>








                    </div>


            </div>



            </div>
        </div>
    </div>
    <script>
        let apiToken = '';
        let page = 1;



        function loadBreweries() {
                                document.getElementById('message').style.display = 'block';
                                // Recupera il token dall'input Blade
                                const apiToken = @json(session('apiToken'));


                                // Imposta Axios con il token di autorizzazione
                                axios.defaults.headers.common['Authorization'] = `Bearer ${apiToken}`;

                                // Chiamata API protetta
                                axios.get('/api/breweries')
                                    .then(response => {
                                        // Manipola i dati ricevuti dall'API
                                        //const dataContainer = document.getElementById('data-container');
                                        const responseData = response.data;
                                        const breweries = responseData.allItems.data;

                                        const tableBody = document.querySelector("#breweryTable tbody");
                                        const paginationRow = document.getElementById('paginationRow');

                                        breweries.forEach(brewery => {
                                                const row = document.createElement("tr");

                                                row.innerHTML = `
                                                    <td>${brewery.name}</td>
                                                    <td>${brewery.brewery_type}</td>
                                                    <td>${brewery.city}</td>
                                                    <td>${brewery.state}</td>
                                                    <td><a href="${brewery.website_url}" target="_blank">${brewery.website_url || "N/A"}</a></td>
                                                `;

                                                tableBody.appendChild(row);
                                            }); // End foreach

                                            const links = responseData.allItems.links;
                                            // Genera i link di paginazione
                                                links.forEach(link => {
                                                    const cell = document.createElement("td");
                                                    if (link.url) {
                                                        const anchor = document.createElement("a");
                                                        anchor.href = link.url;
                                                        anchor.textContent = link.label;
                                                        anchor.style.color = link.active ? "red" : "blue"; // Stile per il link attivo
                                                        cell.appendChild(anchor);
                                                    } else {
                                                        cell.textContent = link.label === "pagination.previous" ? "«" : "»";
                                                        cell.style.color = "grey"; // Nessun link disponibile
                                                    }
                                                    paginationRow.appendChild(cell);
                                                });

                                                document.getElementById('breweriesSection').style.display = 'block';
                                                document.getElementById('message').style.display = 'none';


                                    })
                                    .catch(error => {
                                        console.error('Errore nella chiamata API:', error);
                                    });


                            }
    </script>
</x-app-layout>


