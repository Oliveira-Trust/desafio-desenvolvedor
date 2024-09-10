from rest_framework.routers import SimpleRouter
from .views import ArquivosAPIViewSet, PesquisaAPIViewSet

router = SimpleRouter()

#http://127.0.0.1:8000/api/arquivo/?data=2024-09-03&nome=InstrumentsConsolidatedFile_20240829_1.csv
router.register('arquivo', ArquivosAPIViewSet, basename='arquivo')
#http://127.0.0.1:8000/api/query/?data=2024-09-04&nome=InstrumentsConsolidatedFile_20240829_1.csv&n=RptDt
router.register('query', PesquisaAPIViewSet, basename='search')
 