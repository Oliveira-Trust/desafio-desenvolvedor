from django.db import models

class BaseModel(models.Model):
    created_at = models.DateTimeField(verbose_name="Data de criação", auto_now_add=True)
    updated_at = models.DateTimeField(verbose_name="Data de atualização", auto_now=True)

    class Meta:
        abstract = True

class Instrument(models.Model):
    # TODO: Voltar a usar o relacionamento com o arquivo
    # instrument_file = models.ForeignKey('InstrumentFile', on_delete=models.CASCADE)
    RptDt = models.CharField(max_length=255)
    TckrSymb = models.CharField(max_length=255)
    Asst = models.CharField(max_length=255, null=True, blank=True)
    AsstDesc = models.CharField(max_length=255, null=True, blank=True)
    SgmtNm = models.CharField(max_length=255, null=True, blank=True)
    MktNm = models.CharField(max_length=255, null=True, blank=True)
    SctyCtgyNm = models.CharField(max_length=255, null=True, blank=True)
    XprtnDt = models.CharField(max_length=255, null=True, blank=True)
    XprtnCd = models.CharField(max_length=255, null=True, blank=True)
    TradgStartDt = models.CharField(max_length=255, null=True, blank=True)
    TradgEndDt = models.CharField(max_length=255, null=True, blank=True)
    BaseCd = models.FloatField(null=True)
    ConvsCritNm = models.CharField(max_length=255, null=True, blank=True)
    MtrtyDtTrgtPt = models.FloatField(null=True)
    ReqrdConvsInd = models.CharField(max_length=255, null=True, blank=True)
    ISIN = models.CharField(max_length=255, null=True, blank=True)
    CFICd = models.CharField(max_length=255, null=True, blank=True)
    DlvryNtceStartDt = models.CharField(max_length=255, null=True, blank=True)
    DlvryNtceEndDt = models.CharField(max_length=255, null=True, blank=True)
    OptnTp = models.CharField(max_length=255, null=True, blank=True)
    CtrctMltplr = models.CharField(max_length=255, null=True, blank=True)
    AsstQtnQty = models.FloatField(null=True)
    AllcnRndLot = models.IntegerField(null=True, blank=True)
    TradgCcy = models.CharField(max_length=255, null=True, blank=True)
    DlvryTpNm = models.CharField(max_length=255, null=True, blank=True)
    WdrwlDays = models.FloatField(null=True)
    WrkgDays = models.FloatField(null=True)
    ClnrDays = models.FloatField(null=True)
    RlvrBasePricNm = models.CharField(max_length=255, null=True, blank=True)
    OpngFutrPosDay = models.FloatField(null=True)
    SdTpCd1 = models.CharField(max_length=255, null=True, blank=True)
    UndrlygTckrSymb1 = models.CharField(max_length=255, null=True, blank=True)
    SdTpCd2 = models.CharField(max_length=255, null=True, blank=True)
    UndrlygTckrSymb2 = models.CharField(max_length=255, null=True, blank=True)
    PureGoldWght = models.FloatField(null=True)
    ExrcPric = models.CharField(max_length=255, null=True, blank=True)
    OptnStyle = models.CharField(max_length=255, null=True, blank=True)
    ValTpNm = models.CharField(max_length=255, null=True, blank=True)
    PrmUpfrntInd = models.CharField(max_length=255, null=True, blank=True)
    OpngPosLmtDt = models.CharField(max_length=255, null=True, blank=True)
    DstrbtnId = models.FloatField(null=True)
    PricFctr = models.FloatField(null=True)
    DaysToSttlm = models.FloatField(null=True)
    SrsTpNm = models.CharField(max_length=255, null=True, blank=True)
    PrtcnFlg = models.CharField(max_length=255, null=True, blank=True)
    AutomtcExrcInd = models.CharField(max_length=255, null=True, blank=True)
    SpcfctnCd = models.CharField(max_length=255, null=True, blank=True)
    CrpnNm = models.CharField(max_length=255, null=True, blank=True)
    CorpActnStartDt = models.CharField(max_length=255, null=True, blank=True)
    CtdyTrtmntTpNm = models.CharField(max_length=255, null=True, blank=True)
    MktCptlstn = models.FloatField(null=True)
    CorpGovnLvlNm = models.CharField(max_length=255, null=True, blank=True)

    def __str__(self):
        return self.RptDt

class InstrumentFile(BaseModel):
    file = models.FileField(upload_to='instruments/')

    def __str__(self):
        return self.file.name