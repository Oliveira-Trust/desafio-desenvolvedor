from django.db import models
from django.utils import timezone

class File(models.Model):

    name = models.CharField(max_length=100, null=True, blank=False, default='name')       
    RptDt = models.DateField()
    TckrSymb = models.CharField(max_length=50, null=False, blank=False)
    MktNm = models.CharField(max_length=50, null=False, blank=False)
    SctyCtgyNm = models.CharField(max_length=50, null=False, blank=False)
    ISIN =  models.CharField(max_length=50, null=False, blank=False)
    CrpnNm =  models.CharField(max_length=50, null=False, blank=False)
    upload_date = models.DateField(blank=True, default='', null=True)
   

    class Meta:
        ordering = ('-upload_date',) 
        indexes = [
            models.Index(fields=['-name'])]
        

    def __str__(self):
        return self.name
    
