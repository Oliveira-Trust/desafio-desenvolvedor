from django.db import models

class UploadHistory(models.Model):
    file_name = models.CharField(max_length=255, unique=True)  
    uploaded_at = models.DateTimeField(auto_now_add=True)
    reference_date = models.DateField()

    def __str__(self):
        return f"{self.file_name} - {self.reference_date}"
