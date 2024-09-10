# Generated by Django 5.1 on 2024-09-03 18:58

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='File',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(default='name', max_length=100, null=True)),
                ('RptDt', models.DateField()),
                ('TckrSymb', models.CharField(max_length=50)),
                ('MktNm', models.CharField(max_length=50)),
                ('SctyCtgyNm', models.CharField(max_length=50)),
                ('ISIN', models.CharField(max_length=50)),
                ('CrpnNm', models.CharField(max_length=50)),
                ('upload_date', models.DateField()),
            ],
            options={
                'ordering': ('-upload_date',),
                'indexes': [models.Index(fields=['-name'], name='fileupload__name_8bd4da_idx')],
            },
        ),
    ]
