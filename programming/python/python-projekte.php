<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/python-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <?php renderPythonNavigation('python-projekte'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-rocket text-primary me-2"></i>Python Projekte & Best Practices</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>🎯 Abschlussprojekte</h2>
                        <p>Hier sind <strong>vollständige Python-Projekte</strong>, die alle bisher gelernten Konzepte integrieren. Diese Projekte zeigen reale Anwendungsfälle und Best Practices.</p>
                        
                        <div class="projects-overview">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card">
                                        <i class="bi bi-bank text-success"></i>
                                        <h5>Bankensystem</h5>
                                        <p>OOP, Datenvalidierung, Persistence</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card">
                                        <i class="bi bi-graph-up text-info"></i>
                                        <h5>Datenanalyse-Tool</h5>
                                        <p>CSV-Verarbeitung, Statistiken, Visualisierung</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card">
                                        <i class="bi bi-globe text-warning"></i>
                                        <h5>Web API Client</h5>
                                        <p>HTTP-Requests, JSON, Error-Handling</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card">
                                        <i class="bi bi-file-text text-primary"></i>
                                        <h5>Text-Analysator</h5>
                                        <p>Regex, NLP-Grundlagen, Reporting</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card">
                                        <i class="bi bi-controller text-danger"></i>
                                        <h5>CLI-Spiel</h5>
                                        <p>Game-Logic, User-Input, State-Management</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card">
                                        <i class="bi bi-calendar-event text-secondary"></i>
                                        <h5>Task-Manager</h5>
                                        <p>Terminplanung, Persistenz, Notifications</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>🏦 Projekt 1: Vollständiges Bankensystem</h2>
                        <p>Ein umfassendes Bankensystem mit OOP, Datenvalidierung, Logging und Persistenz.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
PROJEKT 1: Vollständiges Bankensystem
Integriert: OOP, Exception-Handling, Logging, JSON-Persistenz, Testing
"""

import json
import logging
import datetime
from decimal import Decimal
from typing import List, Dict, Optional
from dataclasses import dataclass, asdict
from pathlib import Path
import uuid

# Logging konfigurieren
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('bank_system.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger('BankSystem')

# Custom Exceptions
class BankingException(Exception):
    """Basis-Exception für Banking-Fehler"""
    pass

class InsufficientFundsException(BankingException):
    """Nicht genügend Guthaben"""
    pass

class InvalidAccountException(BankingException):
    """Ungültiges Konto"""
    pass

class InvalidAmountException(BankingException):
    """Ungültiger Betrag"""
    pass

# Datenklassen
@dataclass
class Transaction:
    """Transaktion"""
    id: str
    from_account: str
    to_account: str
    amount: Decimal
    transaction_type: str
    timestamp: datetime.datetime
    description: str
    
    def to_dict(self):
        """Konvertiert zu Dictionary für JSON"""
        return {
            'id': self.id,
            'from_account': self.from_account,
            'to_account': self.to_account,
            'amount': str(self.amount),
            'transaction_type': self.transaction_type,
            'timestamp': self.timestamp.isoformat(),
            'description': self.description
        }

@dataclass
class Account:
    """Bankkonto"""
    account_number: str
    owner_name: str
    balance: Decimal
    account_type: str
    created_at: datetime.datetime
    is_active: bool = True
    
    def to_dict(self):
        """Konvertiert zu Dictionary für JSON"""
        return {
            'account_number': self.account_number,
            'owner_name': self.owner_name,
            'balance': str(self.balance),
            'account_type': self.account_type,
            'created_at': self.created_at.isoformat(),
            'is_active': self.is_active
        }

# Hauptklassen
class BankAccount:
    """Einzelnes Bankkonto mit Geschäftslogik"""
    
    def __init__(self, account_number: str, owner_name: str, 
                 initial_balance: Decimal = Decimal('0.00'), 
                 account_type: str = 'CHECKING'):
        self.account = Account(
            account_number=account_number,
            owner_name=owner_name,
            balance=initial_balance,
            account_type=account_type,
            created_at=datetime.datetime.now()
        )
        self.transaction_history: List[Transaction] = []
        
        logger.info(f"Konto erstellt: {account_number} für {owner_name}")
    
    def deposit(self, amount: Decimal, description: str = "") -> Transaction:
        """Einzahlung"""
        self._validate_amount(amount)
        
        transaction = Transaction(
            id=str(uuid.uuid4()),
            from_account="EXTERNAL",
            to_account=self.account.account_number,
            amount=amount,
            transaction_type="DEPOSIT",
            timestamp=datetime.datetime.now(),
            description=description or f"Einzahlung auf {self.account.account_number}"
        )
        
        self.account.balance += amount
        self.transaction_history.append(transaction)
        
        logger.info(f"Einzahlung: {amount} auf {self.account.account_number}")
        return transaction
    
    def withdraw(self, amount: Decimal, description: str = "") -> Transaction:
        """Abhebung"""
        self._validate_amount(amount)
        
        if self.account.balance < amount:
            raise InsufficientFundsException(
                f"Nicht genügend Guthaben. Verfügbar: {self.account.balance}, Angefordert: {amount}"
            )
        
        transaction = Transaction(
            id=str(uuid.uuid4()),
            from_account=self.account.account_number,
            to_account="EXTERNAL",
            amount=amount,
            transaction_type="WITHDRAWAL",
            timestamp=datetime.datetime.now(),
            description=description or f"Abhebung von {self.account.account_number}"
        )
        
        self.account.balance -= amount
        self.transaction_history.append(transaction)
        
        logger.info(f"Abhebung: {amount} von {self.account.account_number}")
        return transaction
    
    def get_balance(self) -> Decimal:
        """Kontostand abfragen"""
        return self.account.balance
    
    def get_statement(self, days: int = 30) -> List[Transaction]:
        """Kontoauszug für bestimmten Zeitraum"""
        cutoff_date = datetime.datetime.now() - datetime.timedelta(days=days)
        
        recent_transactions = [
            t for t in self.transaction_history 
            if t.timestamp >= cutoff_date
        ]
        
        return sorted(recent_transactions, key=lambda x: x.timestamp, reverse=True)
    
    def _validate_amount(self, amount: Decimal):
        """Validiert Betrag"""
        if amount <= 0:
            raise InvalidAmountException("Betrag muss positiv sein")
        
        if amount > Decimal('1000000'):
            raise InvalidAmountException("Betrag zu hoch (max. 1.000.000)")

class Bank:
    """Hauptbank-Klasse"""
    
    def __init__(self, name: str, data_file: str = "bank_data.json"):
        self.name = name
        self.data_file = Path(data_file)
        self.accounts: Dict[str, BankAccount] = {}
        self.all_transactions: List[Transaction] = []
        self.next_account_number = 10001
        
        self.load_data()
        logger.info(f"Bank '{name}' initialisiert mit {len(self.accounts)} Konten")
    
    def create_account(self, owner_name: str, initial_deposit: Decimal = Decimal('0.00'),
                      account_type: str = 'CHECKING') -> BankAccount:
        """Neues Konto erstellen"""
        if not owner_name.strip():
            raise ValueError("Eigentümername darf nicht leer sein")
        
        account_number = f"ACC{self.next_account_number}"
        self.next_account_number += 1
        
        account = BankAccount(account_number, owner_name, initial_deposit, account_type)
        self.accounts[account_number] = account
        
        if initial_deposit > 0:
            account.deposit(initial_deposit, "Ersteinzahlung")
        
        self.save_data()
        logger.info(f"Neues Konto erstellt: {account_number} für {owner_name}")
        return account
    
    def get_account(self, account_number: str) -> BankAccount:
        """Konto abrufen"""
        if account_number not in self.accounts:
            raise InvalidAccountException(f"Konto {account_number} nicht gefunden")
        
        return self.accounts[account_number]
    
    def transfer(self, from_account: str, to_account: str, amount: Decimal, 
                description: str = "") -> tuple[Transaction, Transaction]:
        """Überweisung zwischen Konten"""
        source = self.get_account(from_account)
        destination = self.get_account(to_account)
        
        if from_account == to_account:
            raise InvalidAccountException("Quelle und Ziel dürfen nicht gleich sein")
        
        # Abhebung vom Quellkonto
        withdrawal = source.withdraw(amount, f"Überweisung an {to_account}")
        
        try:
            # Einzahlung auf Zielkonto
            deposit = destination.deposit(amount, f"Überweisung von {from_account}")
            
            # Überweisungs-Transaktion erstellen
            transfer_transaction = Transaction(
                id=str(uuid.uuid4()),
                from_account=from_account,
                to_account=to_account,
                amount=amount,
                transaction_type="TRANSFER",
                timestamp=datetime.datetime.now(),
                description=description or f"Überweisung {from_account} → {to_account}"
            )
            
            self.all_transactions.append(transfer_transaction)
            self.save_data()
            
            logger.info(f"Überweisung: {amount} von {from_account} an {to_account}")
            return withdrawal, deposit
            
        except Exception as e:
            # Rollback: Geld zurück auf Quellkonto
            source.deposit(amount, f"Rollback: Fehlgeschlagene Überweisung an {to_account}")
            logger.error(f"Überweisung fehlgeschlagen, Rollback durchgeführt: {e}")
            raise
    
    def get_total_deposits(self) -> Decimal:
        """Gesamteinlagen der Bank"""
        return sum(account.get_balance() for account in self.accounts.values())
    
    def get_account_summary(self) -> Dict:
        """Zusammenfassung aller Konten"""
        active_accounts = [acc for acc in self.accounts.values() if acc.account.is_active]
        
        return {
            'total_accounts': len(self.accounts),
            'active_accounts': len(active_accounts),
            'total_deposits': self.get_total_deposits(),
            'account_types': self._get_account_type_distribution()
        }
    
    def _get_account_type_distribution(self) -> Dict[str, int]:
        """Verteilung der Kontotypen"""
        distribution = {}
        for account in self.accounts.values():
            acc_type = account.account.account_type
            distribution[acc_type] = distribution.get(acc_type, 0) + 1
        return distribution
    
    def save_data(self):
        """Daten in JSON-Datei speichern"""
        data = {
            'bank_name': self.name,
            'next_account_number': self.next_account_number,
            'accounts': {},
            'transactions': []
        }
        
        # Konten serialisieren
        for acc_num, bank_account in self.accounts.items():
            data['accounts'][acc_num] = {
                'account': bank_account.account.to_dict(),
                'transactions': [t.to_dict() for t in bank_account.transaction_history]
            }
        
        # Alle Transaktionen
        data['transactions'] = [t.to_dict() for t in self.all_transactions]
        
        with open(self.data_file, 'w') as f:
            json.dump(data, f, indent=2, default=str)
        
        logger.debug("Daten gespeichert")
    
    def load_data(self):
        """Daten aus JSON-Datei laden"""
        if not self.data_file.exists():
            logger.info("Keine Datendatei gefunden, starte mit leerer Bank")
            return
        
        try:
            with open(self.data_file, 'r') as f:
                data = json.load(f)
            
            self.next_account_number = data.get('next_account_number', 10001)
            
            # Konten laden
            for acc_num, acc_data in data.get('accounts', {}).items():
                account_info = acc_data['account']
                
                # Account-Objekt rekonstruieren
                account = Account(
                    account_number=account_info['account_number'],
                    owner_name=account_info['owner_name'],
                    balance=Decimal(account_info['balance']),
                    account_type=account_info['account_type'],
                    created_at=datetime.datetime.fromisoformat(account_info['created_at']),
                    is_active=account_info['is_active']
                )
                
                # BankAccount erstellen
                bank_account = BankAccount.__new__(BankAccount)  # Ohne __init__
                bank_account.account = account
                bank_account.transaction_history = []
                
                # Transaktionen laden
                for trans_data in acc_data.get('transactions', []):
                    transaction = Transaction(
                        id=trans_data['id'],
                        from_account=trans_data['from_account'],
                        to_account=trans_data['to_account'],
                        amount=Decimal(trans_data['amount']),
                        transaction_type=trans_data['transaction_type'],
                        timestamp=datetime.datetime.fromisoformat(trans_data['timestamp']),
                        description=trans_data['description']
                    )
                    bank_account.transaction_history.append(transaction)
                
                self.accounts[acc_num] = bank_account
            
            logger.info(f"Daten geladen: {len(self.accounts)} Konten")
            
        except Exception as e:
            logger.error(f"Fehler beim Laden der Daten: {e}")
            logger.info("Starte mit leerer Bank")

# Banking-System Demonstration
class BankingSystemDemo:
    """Demonstriert das Banking-System"""
    
    def __init__(self):
        self.bank = Bank("Deutsche Beispielbank")
    
    def run_demo(self):
        """Führt komplette Demo aus"""
        print("=== BANKING-SYSTEM DEMONSTRATION ===")
        
        try:
            # 1. Konten erstellen
            print("\n1. KONTEN ERSTELLEN:")
            alice_account = self.bank.create_account("Alice Müller", Decimal('1000.00'))
            bob_account = self.bank.create_account("Bob Schmidt", Decimal('500.00'))
            charlie_account = self.bank.create_account("Charlie Weber", Decimal('2000.00'), 'SAVINGS')
            
            print(f"   Alice: {alice_account.account.account_number} (Guthaben: {alice_account.get_balance()}€)")
            print(f"   Bob: {bob_account.account.account_number} (Guthaben: {bob_account.get_balance()}€)")
            print(f"   Charlie: {charlie_account.account.account_number} (Guthaben: {charlie_account.get_balance()}€)")
            
            # 2. Transaktionen
            print("\n2. TRANSAKTIONEN:")
            alice_account.deposit(Decimal('300.00'), "Gehalt")
            bob_account.withdraw(Decimal('100.00'), "Bargeld")
            
            print(f"   Alice nach Einzahlung: {alice_account.get_balance()}€")
            print(f"   Bob nach Abhebung: {bob_account.get_balance()}€")
            
            # 3. Überweisungen
            print("\n3. ÜBERWEISUNGEN:")
            self.bank.transfer(
                alice_account.account.account_number,
                bob_account.account.account_number,
                Decimal('200.00'),
                "Schulden zurückzahlen"
            )
            
            print(f"   Alice nach Überweisung: {alice_account.get_balance()}€")
            print(f"   Bob nach Überweisung: {bob_account.get_balance()}€")
            
            # 4. Kontoauszüge
            print("\n4. KONTOAUSZÜGE:")
            alice_statement = alice_account.get_statement(30)
            print(f"   Alice's letzte {len(alice_statement)} Transaktionen:")
            for trans in alice_statement[:3]:  # Nur erste 3
                print(f"     {trans.timestamp.strftime('%d.%m.%Y %H:%M')} - {trans.transaction_type}: {trans.amount}€")
            
            # 5. Bank-Statistiken
            print("\n5. BANK-STATISTIKEN:")
            summary = self.bank.get_account_summary()
            print(f"   Gesamte Konten: {summary['total_accounts']}")
            print(f"   Aktive Konten: {summary['active_accounts']}")
            print(f"   Gesamteinlagen: {summary['total_deposits']}€")
            print(f"   Kontotypen: {summary['account_types']}")
            
            # 6. Fehlerbehandlung demonstrieren
            print("\n6. FEHLERBEHANDLUNG:")
            try:
                alice_account.withdraw(Decimal('10000.00'))
            except InsufficientFundsException as e:
                print(f"   ❌ Fehler erwartet: {e}")
            
            try:
                self.bank.get_account("INVALID")
            except InvalidAccountException as e:
                print(f"   ❌ Fehler erwartet: {e}")
            
            print(f"\n✅ Demo erfolgreich abgeschlossen!")
            
        except Exception as e:
            logger.error(f"Demo-Fehler: {e}")
            print(f"❌ Demo-Fehler: {e}")

# Demo ausführen
if __name__ == "__main__":
    demo = BankingSystemDemo()
    demo.run_demo()
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>📊 Projekt 2: Datenanalyse-Tool</h2>
                        <p>Ein Tool für CSV-Datenanalyse mit Statistiken und Visualisierung.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
PROJEKT 2: Datenanalyse-Tool
Integriert: CSV-Verarbeitung, Statistiken, Datenvisualisierung, Reporting
"""

import csv
import json
import statistics
from pathlib import Path
from typing import List, Dict, Any, Optional, Union
from dataclasses import dataclass, field
from datetime import datetime
import math

@dataclass
class DataColumn:
    """Repräsentiert eine Datenspalte"""
    name: str
    data_type: str
    values: List[Any] = field(default_factory=list)
    null_count: int = 0
    
    def add_value(self, value: str):
        """Fügt Wert hinzu und konvertiert Typ"""
        if not value or value.lower() in ['null', 'none', '', 'n/a']:
            self.null_count += 1
            self.values.append(None)
            return
        
        # Typ-Konvertierung
        try:
            if self.data_type == 'int':
                self.values.append(int(value))
            elif self.data_type == 'float':
                self.values.append(float(value))
            elif self.data_type == 'bool':
                self.values.append(value.lower() in ['true', '1', 'yes', 'y'])
            else:  # string
                self.values.append(str(value))
        except ValueError:
            # Fallback zu String
            self.data_type = 'string'
            self.values.append(str(value))
    
    def get_non_null_values(self):
        """Gibt nicht-null Werte zurück"""
        return [v for v in self.values if v is not None]

class DataAnalyzer:
    """Hauptklasse für Datenanalyse"""
    
    def __init__(self):
        self.columns: Dict[str, DataColumn] = {}
        self.row_count = 0
        self.source_file = None
    
    def load_csv(self, filepath: str, delimiter: str = ',', 
                 encoding: str = 'utf-8', headers: bool = True) -> bool:
        """Lädt CSV-Datei"""
        try:
            self.source_file = filepath
            
            with open(filepath, 'r', encoding=encoding) as file:
                # CSV-Dialect automatisch erkennen
                sample = file.read(1024)
                file.seek(0)
                
                sniffer = csv.Sniffer()
                dialect = sniffer.sniff(sample)
                
                reader = csv.reader(file, dialect)
                
                # Headers verarbeiten
                if headers:
                    header_row = next(reader)
                    column_names = [col.strip() for col in header_row]
                else:
                    # Erste Datenzeile für Spaltenanzahl
                    first_row = next(reader)
                    column_names = [f"Column_{i}" for i in range(len(first_row))]
                    # Erste Zeile als Daten behandeln
                    file.seek(0)
                    reader = csv.reader(file, dialect)
                    if headers:
                        next(reader)  # Headers überspringen
                
                # Spalten initialisieren
                self.columns = {}
                for col_name in column_names:
                    self.columns[col_name] = DataColumn(col_name, 'string')
                
                # Daten laden und Typen erraten
                rows_processed = 0
                for row in reader:
                    if len(row) != len(column_names):
                        continue  # Ungültige Zeilen überspringen
                    
                    rows_processed += 1
                    
                    for i, (col_name, value) in enumerate(zip(column_names, row)):
                        if rows_processed == 1:  # Typ beim ersten Datensatz erraten
                            self.columns[col_name].data_type = self._guess_type(value)
                        
                        self.columns[col_name].add_value(value.strip())
                
                self.row_count = rows_processed
                print(f"✅ CSV geladen: {rows_processed} Zeilen, {len(column_names)} Spalten")
                return True
                
        except Exception as e:
            print(f"❌ Fehler beim Laden der CSV: {e}")
            return False
    
    def _guess_type(self, value: str) -> str:
        """Errät Datentyp basierend auf erstem Wert"""
        if not value or value.lower() in ['null', 'none', '', 'n/a']:
            return 'string'
        
        # Integer prüfen
        try:
            int(value)
            return 'int'
        except ValueError:
            pass
        
        # Float prüfen
        try:
            float(value)
            return 'float'
        except ValueError:
            pass
        
        # Boolean prüfen
        if value.lower() in ['true', 'false', '1', '0', 'yes', 'no', 'y', 'n']:
            return 'bool'
        
        return 'string'
    
    def get_column_stats(self, column_name: str) -> Dict[str, Any]:
        """Berechnet Statistiken für eine Spalte"""
        if column_name not in self.columns:
            return {"error": f"Spalte '{column_name}' nicht gefunden"}
        
        col = self.columns[column_name]
        non_null_values = col.get_non_null_values()
        
        stats = {
            "name": column_name,
            "type": col.data_type,
            "count": len(col.values),
            "non_null_count": len(non_null_values),
            "null_count": col.null_count,
            "null_percentage": (col.null_count / len(col.values)) * 100 if col.values else 0
        }
        
        if not non_null_values:
            return stats
        
        # Numerische Statistiken
        if col.data_type in ['int', 'float']:
            try:
                numeric_values = [v for v in non_null_values if isinstance(v, (int, float))]
                if numeric_values:
                    stats.update({
                        "mean": statistics.mean(numeric_values),
                        "median": statistics.median(numeric_values),
                        "mode": statistics.mode(numeric_values) if len(set(numeric_values)) < len(numeric_values) else None,
                        "std_dev": statistics.stdev(numeric_values) if len(numeric_values) > 1 else 0,
                        "variance": statistics.variance(numeric_values) if len(numeric_values) > 1 else 0,
                        "min": min(numeric_values),
                        "max": max(numeric_values),
                        "range": max(numeric_values) - min(numeric_values),
                        "sum": sum(numeric_values)
                    })
                    
                    # Quartile
                    sorted_values = sorted(numeric_values)
                    n = len(sorted_values)
                    stats.update({
                        "q1": sorted_values[n // 4] if n > 0 else 0,
                        "q3": sorted_values[3 * n // 4] if n > 0 else 0
                    })
            except statistics.StatisticsError:
                pass
        
        # String-Statistiken
        elif col.data_type == 'string':
            string_values = [str(v) for v in non_null_values]
            if string_values:
                lengths = [len(s) for s in string_values]
                unique_values = list(set(string_values))
                
                stats.update({
                    "unique_count": len(unique_values),
                    "most_common": max(set(string_values), key=string_values.count),
                    "avg_length": sum(lengths) / len(lengths),
                    "min_length": min(lengths),
                    "max_length": max(lengths),
                    "top_values": self._get_top_values(string_values, 5)
                })
        
        # Boolean-Statistiken
        elif col.data_type == 'bool':
            bool_values = [v for v in non_null_values if isinstance(v, bool)]
            if bool_values:
                true_count = sum(bool_values)
                false_count = len(bool_values) - true_count
                
                stats.update({
                    "true_count": true_count,
                    "false_count": false_count,
                    "true_percentage": (true_count / len(bool_values)) * 100
                })
        
        return stats
    
    def _get_top_values(self, values: List[str], n: int = 5) -> List[tuple]:
        """Holt häufigste Werte"""
        from collections import Counter
        counter = Counter(values)
        return counter.most_common(n)
    
    def generate_report(self) -> Dict[str, Any]:
        """Generiert vollständigen Analyse-Report"""
        if not self.columns:
            return {"error": "Keine Daten geladen"}
        
        report = {
            "metadata": {
                "source_file": self.source_file,
                "generated_at": datetime.now().isoformat(),
                "row_count": self.row_count,
                "column_count": len(self.columns)
            },
            "overview": {
                "columns": list(self.columns.keys()),
                "data_types": {col.name: col.data_type for col in self.columns.values()},
                "null_counts": {col.name: col.null_count for col in self.columns.values()}
            },
            "column_statistics": {}
        }
        
        # Detaillierte Statistiken für jede Spalte
        for col_name in self.columns:
            report["column_statistics"][col_name] = self.get_column_stats(col_name)
        
        # Datenqualität
        total_cells = self.row_count * len(self.columns)
        total_nulls = sum(col.null_count for col in self.columns.values())
        
        report["data_quality"] = {
            "completeness": ((total_cells - total_nulls) / total_cells) * 100 if total_cells > 0 else 0,
            "total_cells": total_cells,
            "null_cells": total_nulls,
            "quality_score": self._calculate_quality_score()
        }
        
        return report
    
    def _calculate_quality_score(self) -> float:
        """Berechnet Datenqualitäts-Score (0-100)"""
        if not self.columns:
            return 0
        
        factors = []
        
        # Vollständigkeit (50% Gewichtung)
        total_cells = self.row_count * len(self.columns)
        if total_cells > 0:
            null_cells = sum(col.null_count for col in self.columns.values())
            completeness = ((total_cells - null_cells) / total_cells) * 100
            factors.append(completeness * 0.5)
        
        # Konsistenz der Datentypen (30% Gewichtung)
        type_consistency = 0
        for col in self.columns.values():
            if col.data_type != 'string':  # String ist Fallback, also weniger konsistent
                type_consistency += 1
        
        if self.columns:
            type_consistency = (type_consistency / len(self.columns)) * 100 * 0.3
            factors.append(type_consistency)
        
        # Eindeutigkeit (20% Gewichtung)
        uniqueness_score = 0
        for col in self.columns.values():
            non_null_values = col.get_non_null_values()
            if non_null_values:
                unique_ratio = len(set(str(v) for v in non_null_values)) / len(non_null_values)
                uniqueness_score += unique_ratio
        
        if self.columns:
            uniqueness_score = (uniqueness_score / len(self.columns)) * 100 * 0.2
            factors.append(uniqueness_score)
        
        return sum(factors) if factors else 0
    
    def export_report(self, filename: str, format: str = 'json'):
        """Exportiert Report in verschiedene Formate"""
        report = self.generate_report()
        
        if format.lower() == 'json':
            with open(filename, 'w', encoding='utf-8') as f:
                json.dump(report, f, indent=2, ensure_ascii=False, default=str)
        
        elif format.lower() == 'txt':
            with open(filename, 'w', encoding='utf-8') as f:
                f.write("DATENANALYSE-REPORT\n")
                f.write("=" * 50 + "\n\n")
                
                # Metadata
                f.write("METADATEN:\n")
                for key, value in report['metadata'].items():
                    f.write(f"  {key}: {value}\n")
                f.write("\n")
                
                # Overview
                f.write("ÜBERBLICK:\n")
                f.write(f"  Zeilen: {report['metadata']['row_count']}\n")
                f.write(f"  Spalten: {report['metadata']['column_count']}\n")
                f.write(f"  Datenqualität: {report['data_quality']['quality_score']:.1f}/100\n")
                f.write("\n")
                
                # Spalten-Statistiken
                f.write("SPALTEN-STATISTIKEN:\n")
                for col_name, stats in report['column_statistics'].items():
                    f.write(f"\n{col_name} ({stats['type']}):\n")
                    f.write(f"  - Werte: {stats['non_null_count']}/{stats['count']}\n")
                    f.write(f"  - Null-Werte: {stats['null_count']} ({stats['null_percentage']:.1f}%)\n")
                    
                    if 'mean' in stats:
                        f.write(f"  - Durchschnitt: {stats['mean']:.2f}\n")
                        f.write(f"  - Median: {stats['median']:.2f}\n")
                        f.write(f"  - Min/Max: {stats['min']:.2f} / {stats['max']:.2f}\n")
                    
                    if 'unique_count' in stats:
                        f.write(f"  - Eindeutige Werte: {stats['unique_count']}\n")
                        f.write(f"  - Häufigstes: '{stats['most_common']}'\n")
        
        print(f"✅ Report exportiert: {filename}")

# Demo-Daten Generator
class DemoDataGenerator:
    """Generiert Demo-CSV-Daten"""
    
    @staticmethod
    def create_sales_data(filename: str = "sales_data.csv", rows: int = 1000):
        """Erstellt Verkaufsdaten-CSV"""
        import random
        from datetime import datetime, timedelta
        
        products = ["Laptop", "Maus", "Tastatur", "Monitor", "Drucker", "Tablet", "Smartphone"]
        regions = ["Nord", "Süd", "Ost", "West", "Zentral"]
        sales_reps = ["Anna Müller", "Bob Schmidt", "Charlie Weber", "Diana Klein", "Eva Fischer"]
        
        with open(filename, 'w', newline='', encoding='utf-8') as f:
            writer = csv.writer(f)
            writer.writerow(['Datum', 'Produkt', 'Region', 'Verkäufer', 'Menge', 'Einzelpreis', 'Umsatz', 'Rabatt'])
            
            start_date = datetime(2023, 1, 1)
            
            for i in range(rows):
                date = start_date + timedelta(days=random.randint(0, 365))
                product = random.choice(products)
                region = random.choice(regions)
                sales_rep = random.choice(sales_reps)
                quantity = random.randint(1, 50)
                unit_price = round(random.uniform(10, 2000), 2)
                revenue = round(quantity * unit_price, 2)
                discount = round(random.uniform(0, 0.3), 2) if random.random() < 0.3 else 0
                
                writer.writerow([
                    date.strftime('%Y-%m-%d'),
                    product,
                    region,
                    sales_rep,
                    quantity,
                    unit_price,
                    revenue,
                    discount
                ])
        
        print(f"✅ Demo-Daten erstellt: {filename} ({rows} Zeilen)")

# Datenanalyse Demo
class DataAnalysisDemo:
    """Demonstriert das Datenanalyse-Tool"""
    
    def run_demo(self):
        """Führt vollständige Demo aus"""
        print("=== DATENANALYSE-TOOL DEMONSTRATION ===")
        
        # 1. Demo-Daten erstellen
        print("\n1. DEMO-DATEN ERSTELLEN:")
        generator = DemoDataGenerator()
        generator.create_sales_data("demo_sales.csv", 500)
        
        # 2. Daten laden
        print("\n2. DATEN LADEN:")
        analyzer = DataAnalyzer()
        success = analyzer.load_csv("demo_sales.csv")
        
        if not success:
            return
        
        # 3. Spalten-Übersicht
        print("\n3. SPALTEN-ÜBERSICHT:")
        for col_name, col in analyzer.columns.items():
            print(f"   {col_name}: {col.data_type} (Null: {col.null_count}/{len(col.values)})")
        
        # 4. Detaillierte Statistiken
        print("\n4. STATISTIKEN (ausgewählte Spalten):")
        
        # Numerische Spalte
        quantity_stats = analyzer.get_column_stats('Menge')
        print(f"   Menge:")
        print(f"     Durchschnitt: {quantity_stats.get('mean', 'N/A'):.2f}")
        print(f"     Median: {quantity_stats.get('median', 'N/A'):.2f}")
        print(f"     Min/Max: {quantity_stats.get('min', 'N/A')}/{quantity_stats.get('max', 'N/A')}")
        
        # Kategorische Spalte  
        product_stats = analyzer.get_column_stats('Produkt')
        print(f"   Produkt:")
        print(f"     Eindeutige Werte: {product_stats.get('unique_count', 'N/A')}")
        if 'top_values' in product_stats:
            print(f"     Top 3: {product_stats['top_values'][:3]}")
        
        # 5. Vollständiger Report
        print("\n5. REPORT GENERIEREN:")
        report = analyzer.generate_report()
        
        print(f"   Datenqualität: {report['data_quality']['quality_score']:.1f}/100")
        print(f"   Vollständigkeit: {report['data_quality']['completeness']:.1f}%")
        
        # 6. Report exportieren
        print("\n6. EXPORT:")
        analyzer.export_report("analysis_report.json", "json")
        analyzer.export_report("analysis_report.txt", "txt")
        
        # 7. Aufräumen
        print("\n7. AUFRÄUMEN:")
        import os
        for file in ["demo_sales.csv", "analysis_report.json", "analysis_report.txt"]:
            if os.path.exists(file):
                os.remove(file)
                print(f"   Datei entfernt: {file}")
        
        print(f"\n✅ Datenanalyse-Demo erfolgreich abgeschlossen!")

# Demo ausführen
if __name__ == "__main__":
    demo = DataAnalysisDemo()
    demo.run_demo()
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>🎮 Projekt 3: Textbasiertes Adventure-Spiel</h2>
                        <p>Ein vollständiges Adventure-Spiel mit State-Management, Save/Load und komplexer Spiellogik.</p>
                        
                        <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
PROJEKT 3: Textbasiertes Adventure-Spiel
Integriert: OOP, State-Management, JSON-Persistenz, Complex Logic
"""

import json
import random
import os
from typing import Dict, List, Optional, Set
from dataclasses import dataclass, field, asdict
from enum import Enum
from abc import ABC, abstractmethod

# Enums für Spiel-Zustände
class ItemType(Enum):
    WEAPON = "weapon"
    ARMOR = "armor"
    POTION = "potion"
    KEY = "key"
    TREASURE = "treasure"

class Direction(Enum):
    NORTH = "north"
    SOUTH = "south"
    EAST = "east"
    WEST = "west"
    UP = "up"
    DOWN = "down"

# Datenklassen
@dataclass
class Item:
    """Spiel-Gegenstand"""
    name: str
    description: str
    item_type: ItemType
    value: int = 0
    attack_bonus: int = 0
    defense_bonus: int = 0
    heal_amount: int = 0
    
    def use(self, player):
        """Gegenstand verwenden"""
        if self.item_type == ItemType.POTION:
            player.heal(self.heal_amount)
            return f"Du verwendest {self.name} und heilst {self.heal_amount} HP."
        return f"{self.name} kann nicht verwendet werden."

@dataclass
class Monster:
    """Monster-Klasse"""
    name: str
    description: str
    hp: int
    max_hp: int
    attack: int
    defense: int
    exp_reward: int
    gold_reward: int
    loot: List[str] = field(default_factory=list)
    
    def is_alive(self) -> bool:
        return self.hp > 0
    
    def take_damage(self, damage: int):
        """Schaden nehmen"""
        actual_damage = max(1, damage - self.defense)
        self.hp -= actual_damage
        return actual_damage
    
    def attack_damage(self) -> int:
        """Angriffs-Schaden berechnen"""
        return self.attack + random.randint(-2, 2)

@dataclass
class Room:
    """Spielraum"""
    name: str
    description: str
    exits: Dict[Direction, str] = field(default_factory=dict)
    items: List[str] = field(default_factory=list)
    monsters: List[str] = field(default_factory=list)
    visited: bool = False
    
    def get_full_description(self) -> str:
        """Vollständige Raum-Beschreibung"""
        desc = [self.description]
        
        if self.items:
            desc.append(f"Du siehst hier: {', '.join(self.items)}")
        
        if self.monsters:
            desc.append(f"Feinde anwesend: {', '.join(self.monsters)}")
        
        exit_list = [direction.value for direction in self.exits.keys()]
        if exit_list:
            desc.append(f"Ausgänge: {', '.join(exit_list)}")
        
        return "\n".join(desc)

# Spieler-Klasse
class Player:
    """Spieler-Charakter"""
    
    def __init__(self, name: str):
        self.name = name
        self.hp = 100
        self.max_hp = 100
        self.level = 1
        self.exp = 0
        self.exp_to_next_level = 100
        self.gold = 50
        self.attack = 10
        self.defense = 5
        self.inventory: List[str] = []
        self.equipment: Dict[str, Optional[str]] = {
            "weapon": None,
            "armor": None
        }
        self.current_room = "start"
    
    def heal(self, amount: int):
        """Heilung"""
        old_hp = self.hp
        self.hp = min(self.max_hp, self.hp + amount)
        return self.hp - old_hp
    
    def take_damage(self, damage: int) -> int:
        """Schaden nehmen"""
        actual_damage = max(1, damage - self.get_total_defense())
        self.hp -= actual_damage
        return actual_damage
    
    def is_alive(self) -> bool:
        return self.hp > 0
    
    def gain_exp(self, amount: int):
        """Erfahrung sammeln"""
        self.exp += amount
        level_ups = 0
        
        while self.exp >= self.exp_to_next_level:
            level_ups += 1
            self.exp -= self.exp_to_next_level
            self.level += 1
            
            # Stats bei Level-Up erhöhen
            self.max_hp += 20
            self.hp = self.max_hp  # Vollheilung bei Level-Up
            self.attack += 3
            self.defense += 2
            self.exp_to_next_level = int(self.exp_to_next_level * 1.5)
        
        return level_ups
    
    def get_total_attack(self) -> int:
        """Gesamtangriff mit Ausrüstung"""
        total = self.attack
        if self.equipment["weapon"]:
            # Hier würde normalerweise der Waffen-Bonus addiert
            total += 5  # Vereinfacht
        return total
    
    def get_total_defense(self) -> int:
        """Gesamtverteidigung mit Ausrüstung"""
        total = self.defense
        if self.equipment["armor"]:
            # Hier würde normalerweise der Rüstungs-Bonus addiert
            total += 3  # Vereinfacht
        return total
    
    def add_item(self, item_name: str):
        """Gegenstand aufnehmen"""
        self.inventory.append(item_name)
    
    def remove_item(self, item_name: str) -> bool:
        """Gegenstand entfernen"""
        if item_name in self.inventory:
            self.inventory.remove(item_name)
            return True
        return False
    
    def get_status(self) -> str:
        """Status-Information"""
        status = [
            f"=== {self.name} ===",
            f"Level: {self.level}",
            f"HP: {self.hp}/{self.max_hp}",
            f"EXP: {self.exp}/{self.exp_to_next_level}",
            f"Gold: {self.gold}",
            f"Angriff: {self.get_total_attack()}",
            f"Verteidigung: {self.get_total_defense()}",
            f"Inventar: {len(self.inventory)}/20"
        ]
        
        if self.equipment["weapon"]:
            status.append(f"Waffe: {self.equipment['weapon']}")
        if self.equipment["armor"]:
            status.append(f"Rüstung: {self.equipment['armor']}")
        
        return "\n".join(status)

# Spiel-Engine
class GameEngine:
    """Hauptklasse für die Spiel-Engine"""
    
    def __init__(self):
        self.player: Optional[Player] = None
        self.rooms: Dict[str, Room] = {}
        self.items: Dict[str, Item] = {}
        self.monsters: Dict[str, Monster] = {}
        self.game_state = "menu"  # menu, playing, combat, game_over
        self.current_monster: Optional[Monster] = None
        self.save_file = "adventure_save.json"
        
        self.initialize_world()
    
    def initialize_world(self):
        """Initialisiert die Spielwelt"""
        # Items definieren
        self.items = {
            "rostiges_schwert": Item("Rostiges Schwert", "Ein altes, aber noch brauchbares Schwert.", 
                                   ItemType.WEAPON, 50, attack_bonus=5),
            "leder_rüstung": Item("Lederrüstung", "Einfache Lederrüstung für Grundschutz.", 
                                ItemType.ARMOR, 75, defense_bonus=3),
            "heiltrank": Item("Heiltrank", "Stellt 30 HP wieder her.", 
                            ItemType.POTION, 20, heal_amount=30),
            "goldener_schlüssel": Item("Goldener Schlüssel", "Ein glänzender Schlüssel.", 
                                     ItemType.KEY, 100),
            "schatztruhe": Item("Schatztruhe", "Eine schwere Truhe voller Gold.", 
                              ItemType.TREASURE, 500)
        }
        
        # Monster definieren
        self.monsters = {
            "goblin": Monster("Goblin", "Ein kleiner, grüner Räuber.", 
                            30, 30, 8, 2, 25, 15, ["heiltrank"]),
            "ork": Monster("Ork", "Ein großer, brutaler Krieger.", 
                         60, 60, 15, 5, 50, 30, ["rostiges_schwert"]),
            "drache": Monster("Drache", "Ein mächtiger, feuerspeiender Drache.", 
                            200, 200, 25, 10, 200, 500, ["schatztruhe"])
        }
        
        # Räume definieren
        self.rooms = {
            "start": Room(
                "Startraum",
                "Du befindest dich in einem kleinen, düsteren Raum. Fackeln erhellen schwach die Steinwände.",
                {Direction.NORTH: "korridor", Direction.EAST: "lagerraum"}
            ),
            
            "korridor": Room(
                "Langer Korridor", 
                "Ein langer Steingang erstreckt sich vor dir. Echo hallt von den Wänden wider.",
                {Direction.SOUTH: "start", Direction.NORTH: "thronsaal", Direction.WEST: "waffenkammer"},
                monsters=["goblin"]
            ),
            
            "lagerraum": Room(
                "Lagerraum",
                "Ein staubiger Raum voller alter Kisten und Fässer.",
                {Direction.WEST: "start"},
                items=["heiltrank", "heiltrank"]
            ),
            
            "waffenkammer": Room(
                "Waffenkammer",
                "Waffen und Rüstungen verschiedener Zeitalter hängen an den Wänden.",
                {Direction.EAST: "korridor"},
                items=["rostiges_schwert", "leder_rüstung"]
            ),
            
            "thronsaal": Room(
                "Thronsaal",
                "Ein großer Saal mit einem goldenen Thron. Reichtümer sind überall verstreut.",
                {Direction.SOUTH: "korridor", Direction.UP: "drachenhöhle"},
                items=["goldener_schlüssel"]
            ),
            
            "drachenhöhle": Room(
                "Drachenhöhle",
                "Eine riesige Höhle. In der Mitte liegt ein gewaltiger Drache auf einem Schätzhaufen.",
                {Direction.DOWN: "thronsaal"},
                monsters=["drache"],
                items=["schatztruhe"]
            )
        }
    
    def start_new_game(self):
        """Startet neues Spiel"""
        player_name = input("Wie heißt dein Abenteurer? ").strip()
        if not player_name:
            player_name = "Abenteurer"
        
        self.player = Player(player_name)
        self.game_state = "playing"
        
        print(f"\n🎮 Willkommen, {player_name}! Dein Abenteuer beginnt...\n")
        self.look_around()
    
    def save_game(self):
        """Spiel speichern"""
        if not self.player:
            print("❌ Kein aktives Spiel zum Speichern.")
            return
        
        save_data = {
            "player": {
                "name": self.player.name,
                "hp": self.player.hp,
                "max_hp": self.player.max_hp,
                "level": self.player.level,
                "exp": self.player.exp,
                "exp_to_next_level": self.player.exp_to_next_level,
                "gold": self.player.gold,
                "attack": self.player.attack,
                "defense": self.player.defense,
                "inventory": self.player.inventory,
                "equipment": self.player.equipment,
                "current_room": self.player.current_room
            },
            "rooms": {
                room_id: {
                    "visited": room.visited,
                    "items": room.items,
                    "monsters": room.monsters
                } for room_id, room in self.rooms.items()
            },
            "game_state": self.game_state
        }
        
        try:
            with open(self.save_file, 'w') as f:
                json.dump(save_data, f, indent=2)
            print("✅ Spiel gespeichert!")
        except Exception as e:
            print(f"❌ Fehler beim Speichern: {e}")
    
    def load_game(self):
        """Spiel laden"""
        if not os.path.exists(self.save_file):
            print("❌ Kein Spielstand gefunden.")
            return False
        
        try:
            with open(self.save_file, 'r') as f:
                save_data = json.load(f)
            
            # Spieler wiederherstellen
            player_data = save_data["player"]
            self.player = Player(player_data["name"])
            self.player.hp = player_data["hp"]
            self.player.max_hp = player_data["max_hp"]
            self.player.level = player_data["level"]
            self.player.exp = player_data["exp"]
            self.player.exp_to_next_level = player_data["exp_to_next_level"]
            self.player.gold = player_data["gold"]
            self.player.attack = player_data["attack"]
            self.player.defense = player_data["defense"]
            self.player.inventory = player_data["inventory"]
            self.player.equipment = player_data["equipment"]
            self.player.current_room = player_data["current_room"]
            
            # Raum-Zustände wiederherstellen
            for room_id, room_data in save_data["rooms"].items():
                if room_id in self.rooms:
                    self.rooms[room_id].visited = room_data["visited"]
                    self.rooms[room_id].items = room_data["items"]
                    self.rooms[room_id].monsters = room_data["monsters"]
            
            self.game_state = save_data.get("game_state", "playing")
            
            print(f"✅ Spielstand geladen! Willkommen zurück, {self.player.name}!")
            self.look_around()
            return True
            
        except Exception as e:
            print(f"❌ Fehler beim Laden: {e}")
            return False
    
    def look_around(self):
        """Aktuellen Raum beschreiben"""
        if not self.player:
            return
        
        current_room = self.rooms[self.player.current_room]
        current_room.visited = True
        
        print("=" * 50)
        print(f"📍 {current_room.name}")
        print("=" * 50)
        print(current_room.get_full_description())
        print()
    
    def move_player(self, direction: str):
        """Spieler bewegen"""
        if not self.player:
            return
        
        try:
            dir_enum = Direction(direction.lower())
        except ValueError:
            print("❌ Ungültige Richtung. Verwende: north, south, east, west, up, down")
            return
        
        current_room = self.rooms[self.player.current_room]
        
        if dir_enum not in current_room.exits:
            print("❌ Du kannst nicht in diese Richtung gehen.")
            return
        
        # Prüfen ob Monster im Raum sind
        if current_room.monsters:
            print("❌ Du kannst nicht fliehen, solange Feinde anwesend sind!")
            return
        
        next_room_id = current_room.exits[dir_enum]
        self.player.current_room = next_room_id
        
        print(f"🚶 Du gehst nach {direction}...")
        self.look_around()
    
    def take_item(self, item_name: str):
        """Gegenstand aufnehmen"""
        if not self.player:
            return
        
        current_room = self.rooms[self.player.current_room]
        
        if item_name not in current_room.items:
            print(f"❌ '{item_name}' ist hier nicht zu finden.")
            return
        
        if len(self.player.inventory) >= 20:
            print("❌ Dein Inventar ist voll!")
            return
        
        current_room.items.remove(item_name)
        self.player.add_item(item_name)
        
        if item_name in self.items:
            item = self.items[item_name]
            print(f"✅ Du nimmst {item.name} auf: {item.description}")
        else:
            print(f"✅ Du nimmst {item_name} auf.")
    
    def show_inventory(self):
        """Inventar anzeigen"""
        if not self.player:
            return
        
        print("🎒 INVENTAR:")
        if not self.player.inventory:
            print("   Leer")
            return
        
        for item_name in self.player.inventory:
            if item_name in self.items:
                item = self.items[item_name]
                print(f"   • {item.name}: {item.description}")
            else:
                print(f"   • {item_name}")
    
    def attack_monster(self, monster_name: str = None):
        """Monster angreifen"""
        if not self.player:
            return
        
        current_room = self.rooms[self.player.current_room]
        
        if not current_room.monsters:
            print("❌ Hier sind keine Feinde zum Angreifen.")
            return
        
        # Erstes Monster nehmen wenn keines spezifiziert
        if not monster_name:
            monster_name = current_room.monsters[0]
        elif monster_name not in current_room.monsters:
            print(f"❌ '{monster_name}' ist nicht hier.")
            return
        
        # Kampf starten
        monster = self.monsters[monster_name].copy()  # Kopie für diesen Kampf
        self.combat(monster, current_room)
    
    def combat(self, monster: Monster, room: Room):
        """Kampf-System"""
        print(f"\n⚔️  KAMPF BEGINNT gegen {monster.name}!")
        print(f"   {monster.description}")
        print(f"   HP: {monster.hp}/{monster.max_hp}")
        
        while monster.is_alive() and self.player.is_alive():
            print(f"\n--- Runde ---")
            print(f"Du: {self.player.hp}/{self.player.max_hp} HP")
            print(f"{monster.name}: {monster.hp}/{monster.max_hp} HP")
            
            action = input("\nWas möchtest du tun? (angreifen/fliehen/inventar/status): ").strip().lower()
            
            if action in ["angreifen", "attack", "a"]:
                # Spieler greift an
                player_damage = self.player.get_total_attack() + random.randint(-3, 3)
                actual_damage = monster.take_damage(player_damage)
                print(f"🗡️  Du greifst an und machst {actual_damage} Schaden!")
                
                if not monster.is_alive():
                    break  # Monster ist tot
                
                # Monster greift zurück
                monster_damage = monster.attack_damage()
                actual_damage = self.player.take_damage(monster_damage)
                print(f"👹 {monster.name} greift zurück und macht {actual_damage} Schaden!")
                
            elif action in ["fliehen", "flee", "f"]:
                if random.random() < 0.7:  # 70% Flucht-Chance
                    print("🏃 Du fliehst erfolgreich!")
                    return
                else:
                    print("❌ Flucht fehlgeschlagen!")
                    # Monster greift an
                    monster_damage = monster.attack_damage()
                    actual_damage = self.player.take_damage(monster_damage)
                    print(f"👹 {monster.name} greift während deiner Flucht an! {actual_damage} Schaden!")
            
            elif action in ["inventar", "inventory", "i"]:
                self.show_inventory()
                continue  # Keine Runde verbraucht
                
            elif action in ["status", "s"]:
                print(self.player.get_status())
                continue  # Keine Runde verbraucht
            
            else:
                print("❌ Ungültige Aktion.")
                continue  # Keine Runde verbraucht
        
        if not self.player.is_alive():
            print("💀 Du bist gestorben! GAME OVER")
            self.game_state = "game_over"
            return
        
        if not monster.is_alive():
            print(f"🏆 Du hast {monster.name} besiegt!")
            
            # Belohnungen
            level_ups = self.player.gain_exp(monster.exp_reward)
            self.player.gold += monster.gold_reward
            
            print(f"   💰 +{monster.gold_reward} Gold")
            print(f"   ⭐ +{monster.exp_reward} EXP")
            
            if level_ups > 0:
                print(f"   🎉 LEVEL UP! Neues Level: {self.player.level}")
            
            # Loot droppen
            for loot_item in monster.loot:
                if random.random() < 0.5:  # 50% Drop-Chance
                    room.items.append(loot_item)
                    print(f"   📦 {loot_item} wurde fallen gelassen!")
            
            # Monster aus Raum entfernen
            room.monsters.remove(monster.name)
    
    def process_command(self, command: str):
        """Befehl verarbeiten"""
        if not command.strip():
            return
        
        parts = command.strip().lower().split()
        cmd = parts[0]
        args = parts[1:] if len(parts) > 1 else []
        
        if cmd in ["hilfe", "help", "h"]:
            self.show_help()
        
        elif cmd in ["schaue", "look", "l"]:
            self.look_around()
        
        elif cmd in ["gehe", "go", "g"] and args:
            self.move_player(args[0])
        
        elif cmd in ["nimm", "take", "t"] and args:
            item_name = "_".join(args)
            self.take_item(item_name)
        
        elif cmd in ["inventar", "inventory", "i"]:
            self.show_inventory()
        
        elif cmd in ["status", "stats", "s"]:
            print(self.player.get_status())
        
        elif cmd in ["angreifen", "attack", "a"]:
            monster_name = "_".join(args) if args else None
            self.attack_monster(monster_name)
        
        elif cmd in ["speichern", "save"]:
            self.save_game()
        
        elif cmd in ["laden", "load"]:
            self.load_game()
        
        elif cmd in ["beenden", "quit", "q"]:
            self.save_game()
            self.game_state = "quit"
        
        else:
            print("❌ Unbekannter Befehl. Verwende 'hilfe' für eine Liste der Befehle.")
    
    def show_help(self):
        """Hilfe anzeigen"""
        help_text = """
🎯 ADVENTURE-SPIEL BEFEHLE:

Bewegung:
  gehe/go <richtung>  - Bewege dich (north, south, east, west, up, down)

Interaktion:
  schaue/look         - Raum erneut betrachten
  nimm/take <item>    - Gegenstand aufnehmen
  inventar/inventory  - Inventar anzeigen
  angreifen/attack    - Monster angreifen

Charakter:
  status/stats        - Charakterstatus anzeigen

Spiel:
  speichern/save      - Spiel speichern
  laden/load          - Spiel laden
  hilfe/help          - Diese Hilfe
  beenden/quit        - Spiel beenden

Beispiele:
  gehe north          - Gehe nach Norden
  nimm heiltrank      - Heiltrank aufnehmen
  angreifen goblin    - Goblin angreifen
        """
        print(help_text)
    
    def run(self):
        """Hauptspiel-Loop"""
        print("🏰 WILLKOMMEN ZUM TEXTADVENTURE! 🏰")
        
        while True:
            if self.game_state == "menu":
                choice = input("\n1. Neues Spiel\n2. Spiel laden\n3. Beenden\nWähle (1-3): ").strip()
                
                if choice == "1":
                    self.start_new_game()
                elif choice == "2":
                    if self.load_game():
                        self.game_state = "playing"
                elif choice == "3":
                    print("👋 Auf Wiedersehen!")
                    break
                else:
                    print("❌ Ungültige Auswahl.")
            
            elif self.game_state == "playing":
                try:
                    command = input(f"\n[{self.player.name}@{self.rooms[self.player.current_room].name}]> ").strip()
                    self.process_command(command)
                    
                    if self.game_state == "quit":
                        print("👋 Spiel beendet!")
                        break
                        
                except KeyboardInterrupt:
                    print("\n\n⚠️  Spiel unterbrochen!")
                    self.save_game()
                    break
                except EOFError:
                    break
            
            elif self.game_state == "game_over":
                print("\n💀 GAME OVER! Möchtest du nochmal spielen?")
                choice = input("(j/n): ").strip().lower()
                if choice in ["j", "ja", "y", "yes"]:
                    self.game_state = "menu"
                else:
                    break

# Demo starten
if __name__ == "__main__":
    game = GameEngine()
    game.run()
</code></pre>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>🏆 Best Practices & Zusammenfassung</h2>
                        <p>Die wichtigsten Erkenntnisse und Best Practices aus dem Python-Tutorial.</p>
                        
                        <div class="best-practices-grid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="practice-category">
                                        <h4><i class="bi bi-code text-success"></i> Code-Qualität</h4>
                                        <ul>
                                            <li><strong>PEP 8</strong> für konsistenten Code-Style</li>
                                            <li><strong>Type Hints</strong> für bessere Lesbarkeit</li>
                                            <li><strong>Docstrings</strong> für Dokumentation</li>
                                            <li><strong>Meaningful Names</strong> für Variablen/Funktionen</li>
                                            <li><strong>DRY-Prinzip</strong> - Don't Repeat Yourself</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="practice-category">
                                        <h4><i class="bi bi-shield-check text-info"></i> Fehlerbehandlung</h4>
                                        <ul>
                                            <li><strong>Spezifische Exceptions</strong> verwenden</li>
                                            <li><strong>Try-Except-Finally</strong> korrekt nutzen</li>
                                            <li><strong>Custom Exceptions</strong> für Domain-Logic</li>
                                            <li><strong>Logging</strong> statt Print für Debugging</li>
                                            <li><strong>Graceful Degradation</strong> bei Fehlern</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="practice-category">
                                        <h4><i class="bi bi-gear text-warning"></i> Performance</h4>
                                        <ul>
                                            <li><strong>List Comprehensions</strong> für Effizienz</li>
                                            <li><strong>Generators</strong> für große Datenmengen</li>
                                            <li><strong>Built-in Funktionen</strong> bevorzugen</li>
                                            <li><strong>Profiling</strong> für Bottleneck-Analyse</li>
                                            <li><strong>Caching</strong> für teure Operationen</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="practice-category">
                                        <h4><i class="bi bi-puzzle text-primary"></i> Architektur</h4>
                                        <ul>
                                            <li><strong>SOLID-Prinzipien</strong> befolgen</li>
                                            <li><strong>Separation of Concerns</strong></li>
                                            <li><strong>Dependency Injection</strong></li>
                                            <li><strong>Design Patterns</strong> anwenden</li>
                                            <li><strong>Modulare Struktur</strong> wählen</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tutorial-summary">
                            <h3>📚 Was Sie gelernt haben</h3>
                            <p>In diesem umfassenden Python-Tutorial haben Sie folgende Bereiche gemeistert:</p>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>🔤 Grundlagen</h5>
                                    <ul class="summary-list">
                                        <li>Python Syntax & Semantik</li>
                                        <li>Variablen & Datentypen</li>
                                        <li>Operatoren & Ausdrücke</li>
                                        <li>Kontrollstrukturen</li>
                                        <li>Funktionen & Lambda</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>🏗️ Erweiterte Konzepte</h5>
                                    <ul class="summary-list">
                                        <li>Objektorientierte Programmierung</li>
                                        <li>Exception Handling</li>
                                        <li>Module & Packages</li>
                                        <li>File I/O & Serialisierung</li>
                                        <li>Regular Expressions</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h5>⚡ Professionelle Tools</h5>
                                    <ul class="summary-list">
                                        <li>Debugging & Testing</li>
                                        <li>Standard Library</li>
                                        <li>Virtual Environments</li>
                                        <li>Code Quality & Profiling</li>
                                        <li>Projektorganisation</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="next-steps">
                            <h3>🚀 Nächste Schritte</h3>
                            <p>Erweitern Sie Ihr Python-Wissen in folgenden Bereichen:</p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>📊 Data Science</h5>
                                    <ul>
                                        <li>NumPy für numerische Berechnungen</li>
                                        <li>Pandas für Datenanalyse</li>
                                        <li>Matplotlib/Seaborn für Visualisierung</li>
                                        <li>Scikit-learn für Machine Learning</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>🌐 Web Development</h5>
                                    <ul>
                                        <li>Django/Flask für Web-Frameworks</li>
                                        <li>FastAPI für moderne APIs</li>
                                        <li>SQLAlchemy für Datenbanken</li>
                                        <li>Celery für asynchrone Tasks</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>🤖 Specialized Areas</h5>
                                    <ul>
                                        <li>Asyncio für asynchrone Programmierung</li>
                                        <li>PyGame für Spiele-Entwicklung</li>
                                        <li>Tkinter/PyQt für GUIs</li>
                                        <li>Selenium für Web Automation</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>🔧 DevOps & Tools</h5>
                                    <ul>
                                        <li>Docker für Containerisierung</li>
                                        <li>pytest für erweiterte Tests</li>
                                        <li>GitHub Actions für CI/CD</li>
                                        <li>mypy für statische Typisierung</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="final-project-ideas">
                            <h3>💡 Projekt-Ideen für die Praxis</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>🏦 Business Applications</h5>
                                    <ul>
                                        <li>Inventarverwaltungssystem</li>
                                        <li>Customer Relationship Management (CRM)</li>
                                        <li>Gehaltsabrechnungssystem</li>
                                        <li>Projektmanagement-Tool</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>🎯 Utility Applications</h5>
                                    <ul>
                                        <li>Password-Manager</li>
                                        <li>File-Organizer</li>
                                        <li>Weather-Dashboard</li>
                                        <li>Personal Finance Tracker</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="conclusion">
                            <h3>🎉 Herzlichen Glückwunsch!</h3>
                            <p class="lead">Sie haben erfolgreich das <strong>Python-Tutorial</strong> abgeschlossen! Sie verfügen nun über:</p>
                            <ul class="conclusion-highlights">
                                <li>✅ <strong>Solides Fundament</strong> in Python-Programmierung</li>
                                <li>✅ <strong>Praktische Erfahrung</strong> mit realen Projekten</li>
                                <li>✅ <strong>Best Practices</strong> für professionelle Entwicklung</li>
                                <li>✅ <strong>Debug- und Test-Fähigkeiten</strong> für Code-Qualität</li>
                                <li>✅ <strong>Projektorganisation</strong> und Code-Architektur</li>
                            </ul>
                            
                            <div class="final-encouragement">
                                <p><strong>🚀 Ihr nächster Schritt:</strong> Wenden Sie Ihr neues Wissen in eigenen Projekten an! 
                                Programmieren lernt man am besten durch Praxis. Suchen Sie sich ein Projekt, das Sie interessiert, 
                                und setzen Sie es um. Die Python-Community ist groß und hilfsbereit - zögern Sie nicht, Fragen zu stellen!</p>
                                
                                <p class="text-center mt-4">
                                    <strong>🐍 Happy Coding mit Python! 🐍</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-projekte'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>