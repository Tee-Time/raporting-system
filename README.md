# raporting-system

What we have so far:
1. 3 Entities: Date, Tradesman, Transaction
2. CRUD for each of these entities (eg. /transaction, /tradesman, /date)
3. unit test for these entities.
4. the main dashboard can be found under /transaction ( where we can list/filter/edit/update/delete/download transactions)
5. we have also an api /api/tradesman/{id}/data/{week}/download in order to download weekly reports based on tradesman id

Things to improve:
1. For the API endpoint: /transaction/, I would also add the value from the URL to the frontend input (to preserve the value even after pressing enter/search).
2. Security improvements
3. Run performance tests
4. Spend more time on unit test
5. Create a login
6. Take advantage of the Date table for the actual queries

