from django.db import models
import os

def get_file_path(instance, filename):
    return os.path.join('instrument_files', filename)

class BaseModel(models.Model):
    created_at = models.DateTimeField(verbose_name="Data de criação", auto_now_add=True)
    updated_at = models.DateTimeField(verbose_name="Data de atualização", auto_now=True)

    class Meta:
        abstract = True

class Instrument(models.Model):
    instrument_file = models.ForeignKey('InstrumentFile', on_delete=models.CASCADE)
    RptDt = models.CharField(max_length=255)
    TckrSymb = models.CharField(max_length=255)
    Asst = models.CharField(max_length=255, blank=True)
    AsstDesc = models.CharField(max_length=255, blank=True)
    SgmtNm = models.CharField(max_length=255, blank=True)
    MktNm = models.CharField(max_length=255, blank=True)
    SctyCtgyNm = models.CharField(max_length=255, blank=True)
    XprtnDt = models.CharField(max_length=255, blank=True)
    XprtnCd = models.CharField(max_length=255, blank=True)
    TradgStartDt = models.CharField(max_length=255, blank=True)
    TradgEndDt = models.CharField(max_length=255, blank=True)
    BaseCd = models.FloatField(null=True)
    ConvsCritNm = models.CharField(max_length=255, blank=True)
    MtrtyDtTrgtPt = models.FloatField(null=True)
    ReqrdConvsInd = models.CharField(max_length=255, blank=True)
    ISIN = models.CharField(max_length=255, blank=True)
    CFICd = models.CharField(max_length=255, blank=True)
    DlvryNtceStartDt = models.CharField(max_length=255, blank=True)
    DlvryNtceEndDt = models.CharField(max_length=255, blank=True)
    OptnTp = models.CharField(max_length=255, blank=True)
    CtrctMltplr = models.CharField(max_length=255, blank=True)
    AsstQtnQty = models.FloatField(null=True)
    AllcnRndLot = models.IntegerField(null=True)
    TradgCcy = models.CharField(max_length=255, blank=True)
    DlvryTpNm = models.CharField(max_length=255, blank=True)
    WdrwlDays = models.FloatField(null=True)
    WrkgDays = models.FloatField(null=True)
    ClnrDays = models.FloatField(null=True)
    RlvrBasePricNm = models.CharField(max_length=255, blank=True)
    OpngFutrPosDay = models.FloatField(null=True)
    SdTpCd1 = models.CharField(max_length=255, blank=True)
    UndrlygTckrSymb1 = models.CharField(max_length=255, blank=True)
    SdTpCd2 = models.CharField(max_length=255, blank=True)
    UndrlygTckrSymb2 = models.CharField(max_length=255, blank=True)
    PureGoldWght = models.FloatField(null=True)
    ExrcPric = models.CharField(max_length=255, blank=True)
    OptnStyle = models.CharField(max_length=255, blank=True)
    ValTpNm = models.CharField(max_length=255, blank=True)
    PrmUpfrntInd = models.CharField(max_length=255, blank=True)
    OpngPosLmtDt = models.CharField(max_length=255, blank=True)
    DstrbtnId = models.FloatField(null=True)
    PricFctr = models.FloatField(null=True)
    DaysToSttlm = models.FloatField(null=True)
    SrsTpNm = models.CharField(max_length=255, blank=True)
    PrtcnFlg = models.CharField(max_length=255, blank=True)
    AutomtcExrcInd = models.CharField(max_length=255, blank=True)
    SpcfctnCd = models.CharField(max_length=255, blank=True)
    CrpnNm = models.CharField(max_length=255, blank=True)
    CorpActnStartDt = models.CharField(max_length=255, blank=True)
    CtdyTrtmntTpNm = models.CharField(max_length=255, blank=True)
    MktCptlstn = models.FloatField(null=True)
    CorpGovnLvlNm = models.CharField(max_length=255, blank=True)

    def __str__(self):
        return f"{self.RptDt}-{self.TckrSymb}"

class InstrumentFile(BaseModel):
    file = models.FileField(upload_to=get_file_path, unique=True)

    def __str__(self):
        return self.file.name


    def save(self, *args, **kwargs):
        super().save(*args, **kwargs)