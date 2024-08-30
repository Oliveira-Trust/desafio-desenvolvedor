from django.db import models
from django.utils import timezone

class File(models.Model):
    
    RptDt = models.DateTimeField()
    TckrSymb = models.CharField(max_length=50, null=False, blank=False)
    MktNm = models.CharField(max_length=50, null=False, blank=False)
    SctyCtgyNm = models.CharField(max_length=50, null=False, blank=False)
    ISIN =  models.CharField(max_length=50, null=False, blank=False)
    CrpnNm =  models.CharField(max_length=50, null=False, blank=False)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ('created_at',) 
        indexes = [
            models.Index(fields=['-RptDt'])]
        

    def __str__(self):
        return self.CrpnNm

    
    
