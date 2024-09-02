from django.db import models
from django.utils import timezone

class File(models.Model):
    
    RptDt = models.DateField()
    TckrSymb = models.CharField(max_length=50, null=False, blank=False)
    MktNm = models.CharField(max_length=50, null=False, blank=False)
    SctyCtgyNm = models.CharField(max_length=50, null=False, blank=False)
    ISIN =  models.CharField(max_length=50, null=False, blank=False)
    CrpnNm =  models.CharField(max_length=50, null=False, blank=False)
   

    class Meta:
        ordering = ('-RptDt',) 
        indexes = [
            models.Index(fields=['-RptDt'])]
        

    def __str__(self):
        return self.CrpnNm

    
    
